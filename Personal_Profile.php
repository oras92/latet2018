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
<meta name="viewport" content="width=device-width, initial-scale=1">
  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
		  <link rel="stylesheet" type="text/css" href= "bootstrap.css">
		 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<html dir="rtl">

<style>


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

            <?php
               $sql = "select * from Users where username ='" .$_SESSION['username'] ."'";
                $result = $conn->query($sql);
                if($result -> num_rows >0) {
                    $row = $result->fetch_assoc();
                }
            ?>
      </header>
<div class="main">

    <h1 style="color:#14BBB1;margin-bottom:19px">הפרופיל שלי<i style="font-size:24px;" class="fa">&#xf2bc;</i></h1> 
          <main class="Personal">
              <section class="Personal_Information">
                  <h2 style="color:#14BBB1;	margin:0;"> פרטים אישיים</h2>
                   שם מלא:
                   <?php echo $row['FirstName'] ." ". $row['LastName'];
                   ?><br/><br/>
                   כתובת דוא"ל:
                   <?php
                    echo $row['Email'];
                   ?> <br/><br/>
                   טלפון:     
                    <?php 
                    echo "0". $row['MobilePhone'];
                   ?>  
                   <br/><br/>
                   תאריך לידה:
                   <?php
                  $date=date_create($row['Birthday']);
                    echo date_format($date,"d/m/Y");
                   ?>
                   <h2 style="color:#14BBB1;margin-bottom:0;"> פעולות</h2>
                 <a href="Schedule.php"> לוז קבוע ומשתנה<i style="font-size:20px;" class="fa">&#xf073;</i></a><br/>
           <!--      <a href="Schedule.php"> <i style="font-size:20px"class="fa">&#xf271;</i> שינוי לוז</a>-->
                 <a href="MyShift.php">המשמרות שלי<i style="font-size:20px" class="fa">&#xf02e;</i></a>
           <!--      <a href="#"> <i style="font-size:20px" class="fa">&#xf0f3;</i> ההתראות שלי</a> -->
              </section>
          </main>
    
</div>
<br><br><br>
	  	  <footer>&copy; כל הזכויות שמורות לשירן יניב, עדי טבת ואור אשכנזי</footer>

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
	  </body>
</html>