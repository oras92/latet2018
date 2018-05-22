 <!DOCTYPE HTML>

<html dir="rtl">
<head>
  		 <title>Latet</title>   
  		 <meta charset="UTF-8">
  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
  		 
  		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		 <script> 
			$(document).ready(function(){
				$("#by_storage").click(function(){
					$("#storage").slideToggle("slow");
				});
			});
			
				$(document).ready(function(){
				$("#by_date").click(function(){
					$("#date").slideToggle("slow");
				});
			});
			
				$(document).ready(function(){
				$("#by_unstaffed").click(function(){
					$("#unstaffed").slideToggle("slow");
				});
			});
		</script>
</head>

<body>
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
      
      <h1 style="text-align:center;"><i style="font-size:24px" class="fa">&#xf02e;</i>הדוחות שלי </h1>
      
        <form action="Myshift2.php">  
        <input type="submit" value="המשמרות שלי - למתנדבים"> 
        </form>
     <!--<a href="MyShift.php"> <i style="color: black; font-size:20px"</i> המשמרות שלי - למתנדבים</a>-->
     
        <h2 id="by_storage"> דוחות מלגאים לפי מחסן</h2>
                <form id="storage" action="report_by_storage.php" method="post">
                    <p><lable> בחר מחסן:
                        <select name="storage" size="1">
                          <option value="--בחר--"> --בחר-- </option>
                          <option value="102">באר שבע</optioin>
                          <option value="105">קריית ביאליק</optioin>
                          <option value="120">הר טוב</optioin>
                        </select>
                    </lable></p>
                    <p><input type="submit" value="Submit"></p>
                </form>

        <h2 id="by_date"> דוח מלגאים לפי תאריך</h2>
            <form id="date" action="" method="POST">
                <p> בחר תאריך תחילה  <input type="date" value="start"</p>
                <p> בחר תאריך סיום   <input type="date" value="finish"</p>
                <p><input type="submit" value="Submit"></p>

            </form>

   
        <h2 id="by_unstaffed"> דוח משמרות לא מאויישות</h2>
            <form id="unstaffed" action="" method="POST">
                <input type="button" onClick="unstaffedShifts()" value="דוח משמרות לא מאויישות">
            </form>


</body>
</html>