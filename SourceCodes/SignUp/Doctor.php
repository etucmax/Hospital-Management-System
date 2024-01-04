<?php
require_once 'config.php';
$name = $Specialist = $fee = $mobile = $email = $gender = $address = $password = "";
$name_err = $Specialist_err = $fee_err = $mobile_err = $email_err = $gender_err = $address_err = $password_err = "";

// Function to sanitize input
function sanitizeInput($data) {
    global $mysqli;
    return $mysqli->real_escape_string($data);
}

if (isset($_POST['signup'])) {
    $input_name = sanitizeInput(trim($_POST['name']));
    $input_specialist = sanitizeInput(trim($_POST['Specialist']));
    $input_fee = sanitizeInput(trim($_POST['fee']));
    $input_mobile = sanitizeInput(trim($_POST['mobile']));
    $input_email = sanitizeInput(trim($_POST['email']));

    if (isset($_POST['gender'])) {
        $input_gender = sanitizeInput(trim($_POST['gender']));
    }

    $input_address = sanitizeInput(trim($_POST['address']));

    if ($_POST['password'] == $_POST['conpassword']) {
        $input_password = sanitizeInput(trim($_POST['password']));
    } else {
        $password_err = "No Match Password";
    }

    if (empty($input_password)) {
        $password_err = "Please Enter password";
    } else {
        // Use md5 function to encrypt the password
        $password = md5($input_password);
    }

    if (empty($input_mobile)) {
        $mobile_err = "Please Enter Mobile Number";
    } else {
        $mobile = $input_mobile;
    }

    if (empty($input_fee)) {
        $fee_err = "Please Enter fee";
    } else {
        $fee = $input_fee;
    }

    if (empty($input_gender)) {
        $gender_err = "Please Enter Gender";
    } else {
        $gender = $input_gender;
    }

    if (empty($input_email)) {
        $email_err = "Please Enter Email";
    } else {
        $query = "SELECT doctor_email FROM doctor WHERE doctor_email = '{$input_email}'";
        $result1 = mysqli_query($mysqli, $query) or die("Email query wrong");
        if (mysqli_num_rows($result1) == 1) {
            $email_err = "Already Use Email";
        } else {
            $email = $input_email;
        }
    }

    if (empty($input_specialist)) {
        $Specialist_err = "Please Enter Specialist";
    } else {
        $Specialist = $input_specialist;
    }

    if (empty($input_name)) {
        $name_err = "Please Enter Name";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    if (empty($input_address)) {
        $address_err = "Please Enter Address";
    } else {
        $address = $input_address;
    }

    if (empty($name_err) && empty($address_err) && empty($email_err) && empty($mobile_err) && empty($Specialist_err) && empty($gender_err) && empty($password_err) && empty($fee_err)) {
        $q = "INSERT INTO doctor (doctor_name, doctor_specialist, doctor_cost, doctor_mobile, doctor_gender, doctor_email, doctor_password, doctor_address) VALUES ('{$name}','{$Specialist}','{$fee}','{$mobile}','{$gender}','{$email}','{$password}','{$address}')";
        mysqli_query($mysqli, $q) or die('Wrong Inser Query');
        header("Location: http://localhost/Final Project 114/LoginPage/DoctorLogin.php");
    }

    mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Doctor Sign Up</title>
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

        .radio {
            width: 10px;
        }

        input,
        select {
            border-radius: 50px;
            width: 300px;
        }

        button {
            width: 100px;
            margin-left: 40px;
            border-radius: 50px;
        }

        textarea {
            width: 300px;
        }
    </style>
</head>

<body>
    <div class="bg-img">
        <div style="margin-top: 10px; margin-left: 500px; background-color: #C0C0C0; width: 400px; height: 870px; opacity: 0.7; border-radius: 50px;">
            <h3 style="background-color: #C0C0C0; padding-left: 105px; padding-top: 30px;padding-bottom: 30px; border-radius: 50px;">Doctor SIGN UP</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="padding-left: 50px">
                <label>Full Name:</label><br>
                <input type="text" name="name"><br><?php echo $name_err ?><br>
                <label>Specialist:</label><br>
                <?php
                require_once 'config.php';
                $sql = "SELECT * FROM Specialist";
                $result = mysqli_query($mysqli, $sql) or die("Select Query Wrong");
                if (mysqli_num_rows($result) > 0) {
                ?>
                    <select name="Specialist">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $row['specialist_name']; ?> "><?php echo $row['specialist_name'] ?></option> <?php
                                                                                                }
                                                                                                ?>
                    </select><br><?php echo $Specialist_err ?><br> <?php
                                                                } else {
                                                                    echo "No Specialist Found";
                                                                }
                                                                mysqli_close($mysqli);
                                                                ?>
                    <label>Professional Fee:</label><br>
                    <input type="number" name="fee"><br><?php echo $fee_err ?><br>
                    <label>Gender:</label><br>
                    <label><input type="radio" name="gender" value="M" class="radio">Male</label>
                    <label><input type="radio" name="gender" value="F" class="radio">Female</label><br><?php echo $gender_err ?><br>
                    <label>Mobile:</label><br>
                    <input type="tel" name="mobile"><br><?php echo $mobile_err ?><br>
                    <label>Email:</label><br>
                    <input type="email" name="email"><br><?php echo $email_err ?><br>
                    <label>Password:</label><br>
                    <input type="Password" name="password"><br><br>
                    <label>Confirm Password:</label><br>
                    <input type="Password" name="conpassword"><br>
                    <?php echo $password_err ?><br><br>
                    <label>Address:</label><br>
                    <textarea rows="2" cols="40" style="margin-left: 0px" name="address"></textarea><br><?php echo $address_err ?><br>
                    <button type="submit" value="Submit" name="signup" style="margin-left: 28px;">Sign Up</button>
                    <button type="reset" value="Reset">Reset</button> <br><br>
                    <label style="margin-left: 35px;">Already Have An Account. <a href="../LoginPage/DoctorLogin.php">Login In</a></label>
            </form>
        </div>
    </div>
</body>

</html>
