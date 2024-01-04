<?php
require_once 'config.php';
$id = $_GET['id'];
$sql = "Delete from Patient where patient_id = '{$id}'";
mysqli_query($mysqli,$sql) or die('Wrong Delete Query');
mysqli_close($mysqli);
header("Location: http://localhost/Final Project 114/ADashboard/ManagePatient.php");
?>