 <!DOCTYPE HTML>
<head>
  		 <TITLE>Latet</TITLE>   
  		 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
		  <link rel="stylesheet" type="text/css" href= "bootstrap.css">
<html dir="rtl">
</head>
<body>
    <header>
        <div class="logo">
            <a href="home_admin.php"><img src="/img/LOGO.jpeg" alt="latet" ;width="120" height="120"></a>
        </div>
		 <nav class="topnav" id="myTopnav">
           <ul id="navbar">
		   <li><a href="javascript:void(0);" class="icon" onclick="myFunction()">תפריט</i></li>
              <li><a href="http://shiranya.mtacloud.co.il/Constraint.php"> אילוצי משמרות</a></li>
              <li><a href="http://shiranya.mtacloud.co.il/Manage_Users.php"> ניהול משתמשים</a></li>
			   <li><a href="http://shiranya.mtacloud.co.il/MyReport.php"> דוחות</a></li>
              <li><a href="http://shiranya.mtacloud.co.il/OurStorages_admin.html"> המחסנים שלנו</a></li>
              <li><a href="https://www.latet.org.il/">אתר לתת</a></li>
            </ul>
        </nav>
		<a id="logout" href="logout.php">התנתקות</a>
     </header>
      
      <main class="home">
      <div>
                <h2>הייעוד של לתת</h2>
                <p>לפעול לצמצום העוני למען יצירת חברה צודקת וטובה יותר, על ידי: סיוע לאוכלוסיות במצוקה על בסיס אוניברסלי, הנעת החברה האזרחית לערבות הדדית ונתינה והובלת שינוי בסדר העדיפויות הלאומי.</p>
       </div> 
  </main>	
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
