<?php
require_once "config.php";
$email = $password = "";
$row = "";
$error = "";
$bool = false;

// Function to sanitize input
function sanitizeInput($data)
{
    global $mysqli;
    return $mysqli->real_escape_string($data);
}

if (isset($_POST['login'])) {
    $input_email = sanitizeInput(trim($_POST['email']));
    $input_password = sanitizeInput(trim($_POST['password']));

    $sql = "SELECT * FROM Doctor";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['doctor_email'] == $input_email && $row['doctor_password'] == md5($input_password)) {
                $bool = true;
                break;
            }
        }
        if ($bool == true) {
            session_start();
            $_SESSION['id'] = $row['doctor_id'];
            header("location: http://localhost/Final Project 114/DDashboard/ ");
        } else {
            $error = "Invalid Email And Password";
        }
    } else {
        $error = "Invalid Email And Password";
    }
}

mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Doctor Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="../logo.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        body {
            background: -webkit-linear-gradient(left, #2f2ff3, rgb(255, 196, 0));
            background-size: cover;
        }

        input {
            width: 230px;
            border-radius: 50px;
        }

        button {
            border-radius: 50px;
            width: 100px;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div style="width: 300px; height: 380px; border-radius: 50px; background-color: #C0C0C0; margin-left: 40%; margin-top: 100px;"><br>
        <h3 style=" padding-left: 75px; margin-top: 40px; border-radius: 20px 20px 0px 0px; ">Doctor Log In</h3><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="padding-left: 30px;">
            <label>Email:</label><br>
            <input type="email" name="email"><br><br>
            <label>Password:</label><br>
            <input type="Password" name="password"><br><?php echo $error ?><br>
            <button type="submit" value="login" name="login">Login</button>
            <button type="reset" value="Reset">Reset</button><br><br>
            <a href="../SignUp/Doctor.php" style="padding-left: 55px;"><label>Create An Account</label></a>
        </form>
    </div>
</body>

</html>
