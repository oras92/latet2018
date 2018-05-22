 <!DOCTYPE HTML>
<head>
  		 <TITLE>Latet</TITLE>   
  		 <meta charset="UTF-8">
  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
  		  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
</head>

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
   
      <H1 style="text-align:center;"><i style="font-size:24px" class="fa">&#xf02e;</i> דוח מתנדבים לפי מחסן </H1>
      
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

$_get_storage= $_POST['storage'];

$sql_storage= "SELECT DISTINCT  User_Id,Shift_Date, Storage_Name  FROM assignments  join Storages on  assignments.Storage_Id = Storages.Storage_Id WHERE Storages.Storage_Id= $_get_storage";
           $result = $conn->query($sql_storage);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ת.ז מתנדב</th><th>תאריך משמרת</th> <th>שם מחסן</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["User_Id"]. "</td><td>" . $row["Shift_Date"]. " </td><td>" . $row["Storage_Name"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
    
?>
           
