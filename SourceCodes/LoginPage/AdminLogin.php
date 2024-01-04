<?php
require_once "config.php";
$email = $password = "";
$error = "";

// Function to sanitize input
function sanitizeInput($data) {
    global $mysqli;
    return $mysqli->real_escape_string($data);
}

if (isset($_POST['Login'])) {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $hashedPassword = md5($password); // Hash the entered password using md5

    $sql = "SELECT * FROM admin";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) > 0) {
        $loginSuccessful = false;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['email'] == $email && $row['password'] == $hashedPassword) {
                $loginSuccessful = true;
                break;
            }
        }
        if ($loginSuccessful) {
            header("location: http://localhost/Final Project 114/ADashboard/");
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
    <title>Admin Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="../logo.png" />
    <!-- Latest compiled and minified CSS -->
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
<br>
<br>

<body>
    <div style="width: 300px; height: 300px; border-radius: 50px; background-color: #C0C0C0; margin-left: 40%; margin-top: 100px;"><br>
        <h3 style=" padding-left: 75px; margin-top: 10px; border-radius: 20px 20px 0px 0px; ">Admin Log In</h3>
        <h4 style="padding-left: 32px; color:red;"><?php echo $error ?><br></h5>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="padding-left: 30px;">
                <label>Email:</label><br>
                <input type="email" name="email"><br><br>
                <label>Password:</label><br>
                <input type="Password" name="password"><br><br>
                <button type="submit" value="Login" name="Login">Login</button>
                <button type="reset" value="Reset">Reset</button>
            </form>
    </div>
</body>

</html>
