<!DOCTYPE HTML>
    <html dir="rtl">
        <head>
          	<TITLE>Latet</TITLE>   
          	<meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
		  <link rel="stylesheet" type="text/css" href= "bootstrap.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
          	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            mysqli_set_charset($conn,"utf8");
            $Uname=$_SESSION['username'];

        ?>
    
        <body>
           <header>
        <div class="logo">
            <a href="home.html"><img src="/img/LOGO.jpeg" alt="latet" ;width="120" height="120"></a>
        </div>
		 <nav class="topnav" id="myTopnav">
           <ul id="navbar">
		   <li><a href="javascript:void(0);" class="icon" onclick="myFunction()">תפריט</i></li>
              <li><a href="http://shiranya.mtacloud.co.il/Personal_Profile.php">פרופיל אישי</a></li>
              <li><a href="http://shiranya.mtacloud.co.il/AddShift.php"> קביעת משמרות</a></li>
              <li><a href="http://shiranya.mtacloud.co.il/OurStorages.html"> המחסנים שלנו</a></li>
              <li><a href="https://www.latet.org.il/">אתר לתת</a></li>
            </ul>
        </nav>
		<a id="logout" href="logout.php">התנתקות</a>
     </header>
             
    <div class="main">
    	  
            <main class="Personal_Schedule">
            
            <h1 style="color: #14BBB1;"> לו"ז אישי</h1>
                <p> מתנדב יקר, <br>
                  במסך הנ"ל תוכל לבצע רישום של הלו"ז השבועי שלך, יש להזין ימים בהם אינך יכול להתנדב .<br>
                  כך שנוכל להתאים בצורה טובה יותר את הצעות המשמרות הנשלחות אלייך. <br>
                  כמובן שבכל זמן תוכל להכנס ולערוך את הלו"ז.<br>
                </p>
               <h2> הוספה ללוח הזמנים האישי</h2>
                    <form action="Schedule.php" method="post">
                        <p><lable> בחר יום:
                            <select name="Day" size="1">
                            <option value="--בחר--"> --בחר-- </option>
                            <option value="1"> א</option>
                            <option value="2">ב</option>
                            <option value="3">ג</option>
                            <option value="4">ד</option>
                            <option value="5"> ה</option>
                            <option value="6">ו</option>
                            </select>
                        </lable></p>
                        <p><lable> האם מדובר באילוץ קבוע
                            <select name="Routine" size="1">
    							<option value="--בחר--"> --בחר-- </option>
    							<option value="NO"> לא קבוע</option>
    							<option value="YES"> קבוע</option>
    						</select>
                        </lable></p>
                        <p>תיאור <input type="text" name="Description"></input></p>
                        <input type="submit" name="schedule" value="הוספה ללוח הזמנים האישי">  </input>
                    </form> 
                     
                    <?php
                        if (isset($_POST['schedule'])){
                            if (($_POST['Day']=="--בחר--" ) || ($_POST['Routine']=="--בחר--" ))
                            {
                                echo "נא למלא את כל הפרטים";
                            }
                            else
                            {
                                $Uname=$_SESSION['username'];
                                $Day=$_POST['Day'];
                                $Routine=$_POST['Routine'];
                                $Description=$_POST['Description'];
                                mysqli_query($conn,"INSERT INTO Personal_Constraint(User_Id,Day,Routine,Description) VALUES ('$Uname','$Day','$Routine','$Description')");
            
                                echo "אילוץ נוסף בהצלחה";
                            }
                        }
            
                    ?> 
                <h2> הצגת לוח הזמנים האישי</h2>
                    <form action="Schedule.php" method="post">
                    <input type="submit" name="show_schedule" value="לחץ להצגת לוח הזמנים"</input>
                    </form>
                    
                    <?php
                        if (isset($_POST['show_schedule']))
                        {
                            $sql_schedule= "SELECT * FROM Personal_Constraint WHERE User_Id= $Uname";
                            $result = $conn->query($sql_schedule);
    
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                if ($row['Day']==1) {$row['Day']="א";}
                                else if($row['Day']==2){$row['Day']="ב";}
                                else if($row['Day']==3){$row['Day']="ג";}
                                else if($row['Day']==4){$row['Day']="ד";}
                                else if($row['Day']==5){$row['Day']="ה";}
                                else {$row['Day']="ו";}
                                
                                if($row['Routine']=="YES"){$row['Routine']="אילוץ קבוע";}
                                    else { $row['Routine']="אילוץ לא קבוע";}
                                
                                echo "<table><tr><th>יום בשבוע</th><th>סוג אילוץ</th> <th>תיאור</th></tr>";
                                    echo "<tr><td>" . $row['Day']. "</td><td>" . $row['Routine']. " </td><td>" . $row['Description']. "</td></tr>";
                                }
                                echo "</table>";
                            }
                            else
                                {
                                    echo "טרם הוספת אילוצים ללוח הזמנים האישי";
                                }  
                        }
       	            ?>
       	            
       	        <h2> עריכת לוח הזמנים </h2>
                    <form action="Schedule.php" method="post">
                        <p><lable> בחר יום:
                            <select name="Day" size="1">
                            <option value="--בחר--"> --בחר-- </option>
                            <option value="1"> א</option>
                            <option value="2">ב</option>
                            <option value="3">ג</option>
                            <option value="4">ד</option>
                            <option value="5"> ה</option>
                            <option value="6">ו</option>
                            </select>
                        </lable></p>
                        <p><lable> האם מדובר באילוץ קבוע
                            <select name="Routine" size="1">
    							<option value="--בחר--"> --בחר-- </option>
    							<option value="NO"> לא קבוע</option>
    							<option value="YES"> קבוע</option>
    						</select>
                        </lable></p>
                        <p>תיאור <input type="text" name="Description"></input></p>
                        <input type="submit" name="edit_schedule" value="שינוי לוח הזמנים">  </input>
                    </form> 
                     
                    <?php
                        if (isset($_POST['edit_schedule'])){
                            if (($_POST['Day']=="--בחר--" ) || ($_POST['Routine']=="--בחר--" ))
                            {
                                echo "נא למלא את כל הפרטים";
                            }
                            else
                            {
                                $Uname=$_SESSION['username'];
                                $Day=$_POST['Day'];
                                $Routine=$_POST['Routine'];
                                $Description=$_POST['Description'];
                                mysqli_query($conn,"UPDATE Personal_Constraint SET User_Id ='$Uname', Day='$Day',Routine='$Routine',Description='$Description' WHERE User_Id = '$Uname' and Day='$Day'");
                                echo "שינוי בוצע בהצלחה";
                            }
                        }
            
                    ?>
       	            
        	</main>
    </div>      	 
   <br><br>
        
          
          
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