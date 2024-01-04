<?php

require_once 'config.php';

$name = $mobile = $email = $gender = $address = $password = $bloodGroup = "";
$name_err = $bloodGroup_err = $mobile_err = $email_err = $gender_err = $address_err = $password_err = "";

if (isset($_POST['signup'])) {

    $input_bloodGroup = $_POST['bloodGroup'];
    $input_name = sanitizeInput($_POST['name']);
    $input_mobile = sanitizeInput($_POST['mobile']);
    $input_email = sanitizeInput($_POST['email']);
    if (isset($_POST['gender'])) $input_gender = sanitizeInput($_POST['gender']);
    $input_address = sanitizeInput($_POST['address']);

    if ($_POST['password'] == $_POST['conpassword']) {
        $input_password = sanitizeInput($_POST['password']);
        // Hash the password before storing it
        $password = md5($input_password);
    } else {
        $password_err = "No Match Password";
    }

    if (empty($input_password)) {
        $password_err = "Please Enter password";
    } else {
        $password = md5($input_password);
    }

    if (empty($input_mobile)) {
        $mobile_err = "Please Enter Mobile Number";
    } else {
        $mobile = $input_mobile;
    }

    if (empty($input_gender)) {
        $gender_err = "Please Enter Gender";
    } else {
        $gender = $input_gender;
    }

    if (empty($input_email)) {
        $email_err = "Please Enter Email";
    } else {
        $query = "SELECT patient_email FROM patient WHERE patient_email = '{$input_email}'";
        $result1 = mysqli_query($mysqli, $query) or die("Email query wrong");
        if (mysqli_num_rows($result1) == 1) {
            $email_err = "Already Use Email";
        } else {
            $email = $input_email;
        }
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

    $bloodGroup = $input_bloodGroup;

    if (empty($name_err) && empty($address_err) && empty($email_err) && empty($mobile_err) && empty($gender_err) && empty($password_err)) {
        $q = "INSERT INTO patient (patient_name,patient_mobile,patient_gender,patient_email,patient_password,patient_address,patient_blood_group) 
              VALUES ('{$name}','{$mobile}','{$gender}','{$email}','{$password}','{$address}','{$bloodGroup}')";
        mysqli_query($mysqli, $q) or die('Wrong Insert Query');
        header("Location: http://localhost/Final Project 114/ADashboard/ManagePatient.php");
    }
    mysqli_close($mysqli);
}

function sanitizeInput($data)
{
    global $mysqli;
    return $mysqli->real_escape_string($data);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add Patient</title>
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
				width: 20px;
			}
			input,select {
				border-radius: 50px;
				width: 300px;
			}
			option,button {
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
		<nav class="navbar navbar-inverse">
  			<div class="container-fluid">
    			<div class="navbar-header">
      				<a class="navbar-brand" href="index.html">Healix Hospital Management System</a>
    			</div>
      			<div class="navbar-header" style="float: right;">
        			<a class="navbar-brand" href="logout.php" >Log Out</a>
      			</div>
  			</div>
		</nav>
		<div style="margin-left: 490px; background-color: #C0C0C0; width: 400px; border-radius: 50px; height: 730px;">
			<h3 style="padding: 20px; margin-left: 108px;">Add Patient</h3>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="padding-left: 50px;">
				<label>Full Name:</label><br>
				<input type="text" name="name"><br><?php echo $name_err ?><br>
				<label>Gender:</label><br>
        		<label><input type="radio" name="gender" value="M" class="radio">Male</label> &nbsp; &nbsp;
        		<label><input type="radio" name="gender" value="F" class="radio">Female</label><br><?php echo $gender_err ?><br>
				<label>Mobile:</label><br>
				<input type="phone" name="mobile"><br><?php echo $mobile_err ?><br>
				<label>Email:</label><br>
				<input type="Email" name="email"><br><?php echo $email_err ?><br>
				<label>Password:</label><br>
				<input type="password" name="password"><br><br>
				<label>Confirm Password:</label><br>
				<input type="password" name="conpassword"><br><?php echo $password_err ?><br>
				<label>Address:</label><br>
				<textarea rows="2",cols="40" style="margin-left: 0px" name="address"></textarea><br><?php echo $address_err ?><br>
				<label for="bloodGroup">Blood Type:</label><br>
       			<select name="bloodGroup">
        			<option value="A+">A+</option>
        			<option value="A-">A-</option>
        			<option value="B+">B+</option>
        			<option value="B-">B-</option>
       				<option value="AB+">AB+</option>
        			<option value="AB-">AB-</option>
       				<option value="O-">O-</option>
        			<option value="O+">O+</option>
         		</select><br><?php echo $bloodGroup_err ?><br>
         		<button type="submit" value="signup" name="signup" style="margin-left: 95px;">ADD</button>
			</form>
		</div>
	</body>
</html>