 <!DOCTYPE HTML>

<html dir="rtl">
    <head>
      		 <title>Latet</title>   
      		 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
		  <link rel="stylesheet" type="text/css" href= "bootstrap.css">      		 
      		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
        <div class="main">

            <h1 style="color: #14BBB1;"> אילוצי משמרות</h1>
             <p>
                  בדף זה ניתן לקבוע משמרות חדשות במחסנים ואת כמות המתנדבים הדרושה לכל משמרת <br>
                  כמו כן, ישנה אפשרות לערוך אילוץ שכבר נקבע או למחוק אילוץ קיים<br>
                  תוכל להיעזר בלוח השנה על מנת לראות את ימי השבוע וחגי ישראל
             </p>
            <main class="schedule">
    	  
        	  <iframe src="https://calendar.google.com/calendar/embed?src=mtalatet%40gmail.com&ctz=Asia%2FJerusalem" style="border: 5px" width="800" height="600" 
        	  frameborder="0" scrolling="no"></iframe> 
        	  <br/>
        	   <br/>
        	    <br/>
     
            </main>
           
                <h2> הוספת אילוץ חדש</h2>
              
              
            <form action="Constraint.php" method="post">
                <p> תאריך משמרת <input type="date" name="Shift_Date"</p>
                <p><lable> בחר מחסן:
                            <select name="storage" size="1">
                              <option value="--בחר--"> --בחר-- </option>
                              <option value="102">באר שבע</optioin>
                              <option value="105">קריית ביאליק</optioin>
                              <option value="120">הר טוב</optioin>
                            </select>
                    </lable></p> 
                <p> כמות מתנדבים דרושה <input type="number" name="Milgaie_Quantity"</p>
                <p><input type="submit" name ="Constraint" value="הוספת אילוץ"> </p>
            </form>
            
            <?php
                if(isset($_POST['Constraint']))
                {
                    if($_POST['Shift_Date']==null)
                        {
                          echo "לא הוזן תאריך";
                        }
                    else if ($_POST['storage']=="--בחר--")
                        {
                            echo "לא נבחר מחסן";
                        }
                    else if ($_POST['Milgaie_Quantity']==0)
                        {
                            echo "לא הוזן מספר מתנדבים נדרש";
                        }
                    else {
                            $_get_date= $_POST['Shift_Date'];
                            $nameOfDay = date('D', strtotime($_get_date));
                            if($nameOfDay=="Sun"){$nameOfDay='ראשון'; }
                                    else if($nameOfDay=="Mon"){$nameOfDay='שני';}
                                    else if($nameOfDay=="Tue"){$nameOfDay='שלישי'; }
                                    else if($nameOfDay=="Wed"){$nameOfDay='רביעי';}
                                    else if($nameOfDay=="Thu"){$nameOfDay='חמישי'; }
                                    else if($nameOfDay=="Fri"){$nameOfDay='שישי'; }
                                    else {$nameOfDay='שבת'; }
                            $_get_storage= $_POST['storage'];
                            $_get_Quantity= $_POST['Milgaie_Quantity'];
                            mysqli_query($conn,"INSERT INTO Shifts(Shift_Date,Shift_Day,Storage_Id,Milgaie_Quantity) values ('$_get_date','$nameOfDay','$_get_storage','$_get_Quantity')");
                            echo "משמרת נוספה בהצלחה!";
                        }
                }
                
            ?>
            
                <h2 id="Constraints"> אילוצים קיימים במערכת</h2>
            <form id="AllConstraints" action="Constraint.php" method="POST">
                <p><input type="submit" name="All_Constraints" value="לצפייה באילוצים הקיימים לחץ כאן"></p>
            </form>
                
            <?php
                if(isset($_POST['All_Constraints']))
                    {
                    $sql_Constraints= "SELECT Shift_Id, Shift_Date,Storage_name, Milgaie_Quantity FROM Shifts join Storages on Shifts.Storage_Id = Storages.Storage_Id order by Shift_Date ";
                    $result = $conn->query($sql_Constraints);
                       if ($result->num_rows > 0) {
                            echo "<table><tr><th>קוד משמרת</th><th>תאריך משמרת</th><th> שם מחסן </th><th> כמות מתנדבים דרושה </th></tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["Shift_Id"]. "</td><td>" . $row["Shift_Date"]. " </td><td>" . $row["Storage_name"]. " </td><td>" . $row["Milgaie_Quantity"]. "</td></tr>";
                            }
                            echo "</table>";
                       }
                       else {echo "לא נמצאו אילוצים במערכת";}
                    }
            ?>
            
            
                    <h3> שינוי אילוצי משמרות </h3>
                <form action="Constraint.php" method="post">
                <p> קוד משמרת <input type="number" name="Change_Shift_Id"</p>
                <p> כמות מתנדבים דרושה <input type="number" name="Change_Milgaie_Quantity"</p>
                <p><input type="submit" name ="Update_Constraint" value="שינוי אילוץ"> </p>
                </form>
                
                <?php
                $Milgaie_Quantity=$_POST['Change_Milgaie_Quantity'];
                $Shift_Id=$_POST['Change_Shift_Id'];
                    if(isset($_POST['Update_Constraint']))
                    {
                        if ($_POST['Change_Shift_Id']==0)
                        {
                            echo "לא הוזן קוד משמרת";
                        }
                        else if ($_POST['Change_Milgaie_Quantity']==0)
                        {
                            echo "לא הוזנה כמות מתנדבים לעדכון";
                        }
                        else
                        {
                            $sql_Change= "SELECT * FROM Shifts WHERE `Shift_Id`=$Shift_Id  ";
                            $result = $conn->query($sql_Change);
                            if ($result->num_rows > 0) 
                            {
                                mysqli_query($conn,"UPDATE `Shifts` SET `Milgaie_Quantity`=$Milgaie_Quantity WHERE `Shift_Id`=$Shift_Id");
                                echo "השינוי בוצע בהצלחה!";
                            }
                            else 
                            {
                             echo "לא קיימת במערכת משמרת עם הקוד שהוזן";
                            }
                        }
                    }
                ?>
                    
                    <h3> מחיקת אילוצי משמרות </h3>
                <form action="Constraint.php" method="post">
                <p> קוד משמרת <input type="number" name="Delete_Shift_Id"</p>
                <p><input type="submit" name ="Delete_Constraint" value="מחיקת אילוץ"> </p>
                </form>
               
                <?php
                $Shift_Id=$_POST['Delete_Shift_Id'];
                        if(isset($_POST['Delete_Constraint']))
                            {
                                if ($_POST['Delete_Shift_Id']==0)
                                {
                                    echo "לא הוזן קוד משמרת";
                                }
                                else 
                                {
                                    $sql_Delete= "SELECT * FROM Shifts WHERE `Shift_Id`=$Shift_Id  ";
                                    $result = $conn->query($sql_Delete);
                                    if ($result->num_rows > 0) 
                                    {
                                        mysqli_query($conn,"DELETE FROM `Shifts` WHERE Shift_Id=$Shift_Id");
                                        echo "האילוץ נמחק בהצלחה!";
                                    }
                                    else 
                                    {
                                     echo "לא קיימת במערכת משמרת עם הקוד שהוזן";
                                    }
                            
                                 
                                }
                            }
                ?>
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