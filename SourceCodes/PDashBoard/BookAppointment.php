<?php
if (isset($_POST['Appointment'])) {
    require_once '../LoginPage/config.php';
    session_start();
    $id = $_SESSION['id'];
    $doctor = $_POST['doctor'];
    $Date = $_POST['Date'];
    $Description = $_POST['Description'];

    // Check if the selected date is in the past
    $currentDate = date("Y-m-d");
    if ($Date < $currentDate) {
        echo '<script>alert("Error: Cannot book appointments for past dates."); window.location.href = "BookAppointment.php";</script>';
        exit;
    }

    $sql = "select doctor_cost from doctor where doctor_id = '{$doctor}'";
    $result = mysqli_query($mysqli, $sql) or die("Wrong Query");
    $row = mysqli_fetch_assoc($result);
    $fee = $row['doctor_cost'];

    $q = "insert into Appointment(appointment_patient_id,appointment_doctor_id,fee,appointment_date,appointment_description) values ('{$id}','{$doctor}','{$fee}','{$Date}','{$Description}')";
    mysqli_query($mysqli, $q) or die("Wrong Query");
    mysqli_close($mysqli);
    header("Location: http://localhost/Final Project 114/PDashboard/ViewAppointment.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link rel="shortcut icon" type="image/x-icon" href="../logo.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        input, select {
            border-radius: 50px;
            width: 200px;
        }
    </style>
</head>

<body style="background: url('../SignUp/PatientSignUp.jpg'); background-repeat: no-repeat;background-size: cover;">
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">Healix Hospital Management System</a>
        </div>
        <div class="navbar-header" style="float: right;">
            <a class="navbar-brand" href="Logout.php">Log Out</a>
        </div>
    </div>
</nav>
<div style="background-color: #c0c0c0; width: 268px; border-radius: 50px; padding: 30px; margin-left: 560px; margin-top:70px;">
    <h3>Book Appointment</h3>
    <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label>Doctor</label><br>
        <?php
        require_once '../LoginPage/config.php';
        $q = "Select * from Doctor";
        $result = mysqli_query($mysqli, $q) or die("Wrong Select Query");
        if (mysqli_num_rows($result) > 0) { ?>
            <select name="doctor">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['doctor_id'] ?>"><?php echo $row['doctor_name'] ?> Professional Fee-<?php echo $row['doctor_cost'] ?> </option> <?php } ?>
            </select><br>
            <?php
        } ?>
        <label>Date:</label><br>
        <input type="date" name="Date"><br>
        <label>Description:</label><br>
        <textarea rows="4" cols="20" name="Description"></textarea><br><br>
        <button type="submit" value="Appointment" class="btn btn-primary" name="Appointment">Appointment</button>
    </form>
</div>
</body>
</html>
