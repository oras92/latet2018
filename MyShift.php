 <!DOCTYPE HTML>
<head>
  		 <TITLE>Latet</TITLE>   
  		 <meta charset="UTF-8">
  		  <meta name="viewport" content="width=device-width, initial-scale=1">
  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
		  <link rel="stylesheet" type="text/css" href= "bootstrap.css">
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
		 <nav class="topnav" id="myTopnav">
           <ul id="navbar">
		   <li><a href="javascript:void(0);" class="icon" onclick="myFunction()">תפריט</a></li>
              <li><a href="http://shiranya.mtacloud.co.il/Personal_Profile.php">פרופיל אישי</a></li>
              <li><a href="http://shiranya.mtacloud.co.il/AddShift.php"> קביעת משמרות</a></li>
              <li><a href="http://shiranya.mtacloud.co.il/OurStorages.html"> המחסנים שלנו</a></li>
              <li><a href="https://www.latet.org.il/">אתר לתת</a></li>
            </ul>
        </nav>
		<a id="logout" href="logout.php">התנתקות</a>
     </header>
<div class="main">

    <h1 style="color:#14BBB1;margin-bottom:19px">המשמרות שלי</h1> 
      
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
   $sql2= "SELECT User_Id, Shift_Date, Storage_Name FROM assignments join Storages on assignments.Storage_Id = Storages.Storage_Id where User_Id ='" .$_SESSION['username'] ."'order by Shift_Date ";
           $result = $conn->query($sql2);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ת.ז מתנדב</th><th>תאריך משמרת</th> <th>שם מחסן</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["User_Id"]. "</td><td>" . $row["Shift_Date"]. " </td><td>" . $row["Storage_Name"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "אינך משובץ לשום משמרת";
}
    
?>


</body>

</div>
	  <script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>

	  <footer>&copy; כל הזכויות שמורות לשירן יניב, עדי טבת ואור אשכנזי</footer>


 </html>
