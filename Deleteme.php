<?php
ob_start();
session_start();
$servername = "zebra.mtacloud.co.il";
$username = "shiranya";
$password = "latet";
$dbname = "shiranya_Latet2018";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

$Uname=$_POST['postuser'];
$Shift=$_POST['postshiftid'];

mysqli_query($conn,"INSERT INTO `Waiting_List`(`User_Id`,'Shift_Id) VALUES ($Uname,$Shift)");
echo "1";
?>