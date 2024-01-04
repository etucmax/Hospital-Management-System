<?php
$old_err = $new_err = ""; 
$new = "";
require_once '../LoginPage/config.php';
session_start();
$id = $_SESSION['id'];

// Function to sanitize input
function sanitizeInput($data) {
    global $mysqli;
    return $mysqli->real_escape_string($data);
}

if (isset($_POST['cpassword'])) {
    $oldpassword = sanitizeInput($_POST['oldpassword']);
    $newpassword = sanitizeInput($_POST['newpassword']);
    $conpassword = sanitizeInput($_POST['conpassword']);

    if ($newpassword != $conpassword) {
        $new_err = "Passwords do not match";
    } elseif (empty($newpassword) && empty($conpassword)) {
        $new_err = "Please enter a password";
    } else {
        $new = md5($newpassword); // Hash the new password using md5
    }

    $q = "SELECT * FROM Patient WHERE patient_id = '{$id}'";
    $result = mysqli_query($mysqli, $q) or die('Wrong Select Query');
    $row = mysqli_fetch_assoc($result);

    if ($row['patient_password'] != md5($oldpassword)) {
        $old_err = "Old Password is not correct";
    }

    if (empty($new_err) && empty($old_err)) {
        $sql = "UPDATE Patient SET patient_password = '{$new}' WHERE patient_id = '{$id}'";
        mysqli_query($mysqli, $sql) or die('Wrong Update Query');
        header("location: http://localhost/Final Project 114/PDashboard/");
    }
}

mysqli_close($mysqli);
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

<body style="background-color: aliceblue;">
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
    <div style="margin-top: 50px; margin-left: 550px; border-radius: 30px; background-color: silver; padding: 30px; width: 300px;">
        <h3 align="center">Change Password</h3>
        <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label>Old Password: </label><br>
            <input type="password" name="oldpassword"><br><?php echo $old_err ?><br>
            <label>New Password: </label><br>
            <input type="password" name="newpassword"><br><br>
            <label>Confirm Password:</label><br>
            <input type="password" name="conpassword"><br><?php echo $new_err ?><br>
            <button type="submit" class="btn btn-primary" name="cpassword" value="cpassword">Change Password</button>
        </form>
    </div>
</body>

</html>
