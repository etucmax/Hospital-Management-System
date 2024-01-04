<?php
$old_err = $new_err = "";
$new = "";
if (isset($_POST['cpassword'])) {

    require_once '../LoginPage/config.php';
    session_start();
    $id = $_SESSION['id'];

    // Sanitize input
    $old_password = mysqli_real_escape_string($mysqli, trim($_POST['oldpassword']));
    $new_password = mysqli_real_escape_string($mysqli, trim($_POST['newpassword']));
    $confirm_password = mysqli_real_escape_string($mysqli, trim($_POST['conpassword']));

    if ($new_password != $confirm_password) {
        $new_err = "No Match Password";
    } elseif (empty($new_password) && empty($confirm_password)) {
        $new_err = "Please Enter Password";
    } else {
        $new = md5($new_password); // Hash the new password
    }

    $q = "SELECT * FROM Doctor WHERE doctor_id = '{$id}'";
    $result = mysqli_query($mysqli, $q) or die('Wrong Select Query');
    $row = mysqli_fetch_assoc($result);

    if ($row['doctor_password'] != md5($old_password)) {
        $old_err = "Old Password is not Match";
    }

    if (empty($new_err) && empty($old_err)) {
        $sql = "UPDATE Doctor SET doctor_password = '{$new}' WHERE doctor_id = '{$id}'";
        mysqli_query($mysqli, $sql) or die('Wrong Update Query');
        header("location: http://localhost/Final Project 114/DDashboard/");
    }

    mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <link rel="shortcut icon" type="image/x-icon" href="../logo.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        input {
            border-radius: 50px;
            width: 220px;
        }
    </style>
</head>

<body style=" background: url('../ADashBoard/DashBoard.jpg'); background-repeat: no-repeat; background-size: cover;">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">Healix Hospital Management System</a>
            </div>
            <div class="navbar-header" style="float: right;">
                <a class="navbar-brand" href="logout.php">Log Out</a>
            </div>
        </div>
    </nav>
    <div style="margin-left: 545px; border-radius: 30px; background-color: silver; padding: 50px; width: 300px;">
        <h3>Change Password</h3>
        <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <label>Old Password: </label><br>
            <input type="Password" name="oldpassword"><br><?php echo $old_err ?><br>
            <label>New Password: </label><br>
            <input type="Password" name="newpassword"><br><br>
            <label>Confirm Password:</label><br>
            <input type="Password" name="conpassword"><br><?php echo $new_err ?><br>
            <button type="submit" class="btn btn-primary" name="cpassword" value="cpassword">Change Password</button>
        </form>
    </div>
</body>

</html>
