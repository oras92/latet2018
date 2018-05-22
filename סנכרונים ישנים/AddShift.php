 <!DOCTYPE HTML>
  <?php
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
mysqli_set_charset($conn, "utf8");
?>
<head>
  		 <TITLE>Latet</TITLE>   
  		 <meta charset="UTF-8">
  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
  		  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<html dir="rtl">
<style>
table {
    width:60%;
    margin:0px auto;

}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
    text-align: center;
}
tr:nth-child(even) {
    background-color:  #ffff66;
}
 tr:nth-child(odd) {
   background-color: #fff;
}
th {
    background-color: #14BBB1;
    color: white;
}

}
</style>
    <body>
            <header>
        <div class="logo">
            <a href="home.html"><img src="/img/LOGO.jpeg" alt="latet" ;width="120" height="120"></a>
        </div>
        <nav>
           <ul id="navbar">
              <li><a href="http://shiranya.mtacloud.co.il/Personal_Profile.php">פרופיל אישי</a></li>
              <li><a href="http://shiranya.mtacloud.co.il/Schedule.php"> קביעת משמרות</a></li>
              <li><a href="http://shiranya.mtacloud.co.il/MyReport.php"> הדוחות שלי</a></li>
              <li><a href="https://www.latet.org.il/">אתר לתת</a></li>
    
            </ul>
        </nav>
		<a id="logout" href="logout.php">התנתקות</a>

     </header>
     <?php
ob_start();
session_start();
$MyConn=mysql_connect("Localhost","shiranya_adte03","adte1205") or die ("No Connection");
mysql_select_db("shiranya_Latet2018") or die ("No Database Name");
mysql_set_charset("utf8");
$Sess= $_SESSION['username'];

$sql999 = "SELECT * FROM Users WHERE username = '$Sess' ";
$result = $conn->query($sql999);
if($result -> num_rows >0) {
$row = $result->fetch_assoc();
}
$Uname=$row['username'];
$date = $_POST['Shift_Date'];
$nameOfDay = date('D', strtotime($date));
$sql333 = "SELECT * FROM Shifts WHERE Shift_Date = '$date' ";
$result2 = $conn->query($sql333);
if($result2 -> num_rows >0) {
$row2 = $result2->fetch_assoc();
$Num_Registered_Quantity=$row2['Registered_Quantity'];
}
$sql111 = "SELECT * FROM assignments WHERE Shift_Date = '$date' ";
$result3 = $conn->query($sql111);
if($result3 -> num_rows >0) {
$row3 = $result3->fetch_assoc();
}
$SelectedStorage=$_POST['Storage'];
echo $SelectedStorage;
if($row2['Milgaie_Quantity'] > 0 && $Num_Registered_Quantity < $row2['Milgaie_Quantity']){
        if($nameOfDay=="Sun"){
            mysql_query("INSERT INTO `assignments`(`Shift_Id`, `Shift_Date`, `Shift_Day`, `User_Id`, `Storage_Id`) VALUES ('1','$date','ראשון','$Uname','$SelectedStorage')");
        }
        else if($nameOfDay=="Mon"){
            mysql_query("INSERT INTO `assignments`(`Shift_Id`, `Shift_Date`, `Shift_Day`, `User_Id`, `Storage_Id`) VALUES ('1','$date','שני','$Uname','$SelectedStorage')");
        }
        else if($nameOfDay=="Tue"){
            mysql_query("INSERT INTO `assignments`(`Shift_Id`, `Shift_Date`, `Shift_Day`, `User_Id`, `Storage_Id`) VALUES ('1','$date','שלישי','$Uname','$SelectedStorage')");
        }
        else if($nameOfDay=="Wed"){
            mysql_query("INSERT INTO `assignments`(`Shift_Id`, `Shift_Date`, `Shift_Day`, `User_Id`, `Storage_Id`) VALUES ('1','$date','רביעי','$Uname','$SelectedStorage')");
        }
        else if($nameOfDay=="Thu"){
            mysql_query("INSERT INTO `assignments`(`Shift_Id`, `Shift_Date`, `Shift_Day`, `User_Id`, `Storage_Id`) VALUES ('1','$date','חמישי','$Uname','$SelectedStorage')");
        }
        else if($nameOfDay=="Fri"){
            mysql_query("INSERT INTO `assignments`(`Shift_Id`, `Shift_Date`, `Shift_Day`, `User_Id`, `Storage_Id`) VALUES ('1','$date','שישי','$Uname','$SelectedStorage')");
        }
        else {
            mysql_query("INSERT INTO `assignments`(`Shift_Id`, `Shift_Date`, `Shift_Day`, `User_Id`, `Storage_Id`) VALUES ('1','$date','שבת','$Uname','$SelectedStorage')");
        }
        mysql_query("UPDATE `Shifts` SET `Registered_Quantity`='$Num_Registered_Quantity'+1 WHERE Shift_Date='$date'");
}
else{
    echo "<script>
    alert('There is no available days');
    </script>";
}
?>

<h1> שיבוץ למשמרות</h1>
                <form action="AddShift.php" method="post">
                    <p><lable> בחר מחסן:
                        <select name="Storage" size="1">
                          <option value="--בחר--"> --בחר-- </option>
                          <option value="120">מחסן הר טוב </option>
                          <option value="102">מחסן באר שבע </option>
                          <option value="105">מחסן קרית ביאליק </option>
                        </select>
                       </lable></p>
                     תאריך משמרת: <input type="date" name="Shift_Date"></input>
                     <br/><br/>
                     שעות המשמרת:  מ-<input id="time" type="time">  עד <input id="time" type="time">
                     <br/><br/>
                     <input type="submit" value="לחץ להוספת משמרת"> </input>
                </form>
    </body>
</html>