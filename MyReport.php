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
?>
<html dir="rtl">
<head>
  		 <title>Latet</title>   
  		 <meta charset="UTF-8">
  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
</head>
<script type="text/javascript">
        function shiftReportByStorage()
        {
           var result="<?php php_fuc();?>"
           alert result;
        }
</script>
<body>
         <header>
     <div class="logo">
     <a href="home.html"><img src="/img/LOGO.jpeg" alt="latet" ;width="120"; height="120"></a>
       </div>
       <nav> <ul id="navbar">
      <li><a href="http://shiranya.mtacloud.co.il/Personal_Profile.php">פרופיל אישי</a></li>
                   <li><a href="https://www.latet.org.il/">אתר לתת</a>
             <li><a href=#> קביעת משמרות</a></li>
            <div class="dropdown">
				<a class="dropbtn" style="font-size:20px;">הדוחות שלי </a>
                   <div class="dropdown-content">
                          <a href="#">דוח שעות</a>
                          <a  href="http://shiranya.mtacloud.co.il/MyShift.php">>דוח משמרות</a>
                        <a href="#">דוח חודשי</a>
             </div>
             </ul>
             </nav>
		<a id="logout" href="logout.php">התנתקות</a>

      </header>
     <h1 style="text-align:center;"><i style="font-size:24px" class="fa">&#xf02e;</i>הדוחות שלי </h1>
    <form action="" method="POST">
    <input type="button" onClick="shiftReportByStorage()" value="דוחות מלגאים לפי מחסן"/><br><br>
    <input type="button" onClick="shiftReportByDate()" value="דוחות מלגאים לפי תאריכים"/><br><br>
    <input type="button" onClick="unstaffedShifts()" value="דוח משמרות לא מאויישות"/>
    </form>
    
      <?php
       function php_fuc ()
       {
           $sql1="SELECT  DISTINCT `User_Id` FROM `assignments` WHERE `Storage_Id`=1";
          $result = $conn-> query($sql1);
           return $result;

       }
        ?>
    
</body>
</html>