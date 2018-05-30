 <?php
 require 'phpmailer/PHPMailerAutoload.php';
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
        $_SESSION['Test']=$_POST['Shift_Date'];
        ?>
  <html dir="rtl">
    <head>
  		 <title>Latet</title>   
  		 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
		  <link rel="stylesheet" type="text/css" href= "bootstrap.css">
		  
  		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	
</head>
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
         <?php
        ob_start();
        session_start();
        mysql_connect("Localhost","shiranya_adte03","adte1205") or die ("No Connection");
        mysql_select_db("shiranya_Latet2018") or die ("No Database Name");
        mysql_set_charset("utf8");
        $Sess= $_SESSION['username'];
        $sql999 = "SELECT * FROM Users WHERE username ='$Sess'";
        $result = $conn->query($sql999);
        if($result -> num_rows >0) {
        $row = $result->fetch_assoc();
        }
        $Uname=$row['username'];
        
        ?>
        
<div class="main">
    <h1 style="color: #14BBB1;">קביעת משמרת</h1>
        <h2 style="color: #14BBB1;">הצגת משמרות קיימות במערכת</h2>
    
                    <form action="AddShift.php" method="post">
                        <p><lable> בחר חודש שבו תרצה להתנדב:
                            <select name="month" size="1">
                              <option value="--בחר--"> --בחר-- </option>
                              <option value="1"> ינואר </option>
                              <option value="2"> פברואר</option>
                              <option value="3"> מרץ </option>
                              <option value="4"> אפריל </option>
                              <option value="5"> מאי </option>
                              <option value="6"> יוני </option>
                              <option value="7"> יולי </option>
                              <option value="8"> אוגוסט </option>
                              <option value="9"> ספטמבר </option>
                              <option value="10"> אוקטובר </option>
                              <option value="11"> נובמבר </option>
                              <option value="12"> דצמבר </option>
                            </select>
                           </lable></p>
                           <input type="submit" name =month1 value="בחירה">  </input>
                            <div id="qwe">
                                <?php  
                                    $Month=$_POST['month'];
                                    if(isset($_POST['month1'])){
                                        if($Month == "--בחר--")
                                        {
                                            echo "לא נבחר חודש, אנא בחר שוב.";
                                        }
                                        else{
                                    	  $sql123 = "SELECT Shift_Date, Shift_Day, Storage_Name
                                    	  FROM Shifts join Storages on Shifts.Storage_Id = Storages.Storage_Id
                                    	  Where MONTH(Shift_Date) = $Month order by Shift_Date ";
                                            $result5 = $conn->query($sql123);
                                           
                                               if($result5 -> num_rows >0) {
                                               echo "<table><tr><th>תאריך משמרת</th><th>יום</th> <th> מחסן</th> </tr>";
                                               // output data of each row
                                               while($row5 = $result5->fetch_assoc()) {
                                               echo "<tr><td>" . $row5["Shift_Date"]. "</td><td>" . $row5["Shift_Day"]. " </td><td>" . $row5["Storage_Name"]. " </td></tr>";
                                               }
                                               echo "</table>";
                                            }
                                            else{
                                               echo "לא נמצאו משמרות לחודש שבחרת";
                                                }
                                            }
                                    }
                               ?>
                            </div>
               <h2 id="ADD" style="color: #14BBB1;"> רישום למשמרת</h2>
                    <form id="Add_Shift" action="AddShift.php" method="post">
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
                         
                         <input type="submit" name="AddShift" value="לחץ להוספת משמרת"> </input>
                    </form>
                    
                    <div id="result">
                    <?php  
                        if(isset ($_POST['AddShift']))
                        {
                            if ($_POST['Storage']=="--בחר--")
                                {
                                    echo "לא נבחר מחסן";
                                }
                            else if ($_POST['Shift_Date']==null)
                            {
                                    echo "לא הוזן תאריך";
                                }
                            else 
                            {
                                $date = $_POST['Shift_Date'];
                                $SelectedStorage=$_POST['Storage'];
                                $nameOfDay = date('D', strtotime($date));
                                $sql333 = "SELECT * FROM Shifts WHERE Shift_Date = '$date' AND Storage_Id='$SelectedStorage'";
                                $result2 = $conn->query($sql333);
                                if($result2 -> num_rows >0) 
                                {
                                    $row2 = $result2->fetch_assoc();
                                    $Num_Registered_Quantity=$row2['Registered_Quantity'];
                                    $Shift_Id=$row2['Shift_Id'];
        
                                if($row2['Milgaie_Quantity'] > 0 && $Num_Registered_Quantity < $row2['Milgaie_Quantity'])
                                    {
                                    if($nameOfDay=="Sun"){$nameOfDay='ראשון'; }
                                    else if($nameOfDay=="Mon"){$nameOfDay='שני';}
                                    else if($nameOfDay=="Tue"){$nameOfDay='שלישי'; }
                                    else if($nameOfDay=="Wed"){$nameOfDay='רביעי';}
                                    else if($nameOfDay=="Thu"){$nameOfDay='חמישי'; }
                                    else if($nameOfDay=="Fri"){$nameOfDay='שישי'; }
                                    else {$nameOfDay='שבת'; }
                                    mysql_query("INSERT INTO `assignments`(`Shift_Id`, `Shift_Date`, `Shift_Day`, `User_Id`, `Storage_Id`) VALUES ('$Shift_Id','$date','$nameOfDay','$Uname','$SelectedStorage')");
                                    mysql_query("UPDATE `Shifts` SET `Registered_Quantity`='$Num_Registered_Quantity'+1 WHERE Shift_Id='$Shift_Id'");
                                    echo "שיבוץ למשמרת בוצע בהצלחה";
                                    }
                                    else if($Num_Registered_Quantity=$row2['Milgaie_Quantity'])
                                        {
                                        echo "<script>
                                        if(confirm('Do you want to add waiting list')==true)
                                        {
                                            window.location.href('WaitingList.php' +'?Uname=$Uname&ShiftId=$Shift_Id');
                                        }
                                        </script>";
                                        }
                                }   
                                else
                                    { echo "לא קיימת משמרת העונה על הפרטים שהוזנו";}
                            }
                            
                        }
                    ?>
                    </div>
    
    			 <h2 id="Delete" style="color: #14BBB1;"> מחיקת רישום למשמרת</h2>
    	
    				<form action="AddShift.php" method="post">
                    <p> קוד משמרת <input type="number" name="Shift_Id"</p>
                    <p><input type="submit" name ="Delete_assignments" value="מחיקת שיבוץ"> </p>
                    </form>
                   
                    <?php
                    $Shift_Id=$_POST['Shift_Id'];
                        if(isset($_POST['Delete_assignments']))
                            {
                                if ($Shift_Id==0)
                                {
                                    echo "לא הוזן קוד משמרת";
                                }
                                else 
                                {
                                    
                                    $sql_Delete= "SELECT * FROM assignments WHERE Shift_Id=$Shift_Id and User_Id=$Uname ";
                                    $result3 = $conn->query($sql_Delete);
                                    if ($result3->num_rows > 0) 
                                    {
                                        $row3 = $result3->fetch_assoc();
                                        $Num_Registered_Quantity=$row3['Registered_Quantity'];
                                        
                                        mysql_query("DELETE FROM assignments WHERE Shift_Id=$Shift_Id and User_Id=$Uname");
                                        mysql_query("UPDATE `Shifts` SET `Registered_Quantity`='$Num_Registered_Quantity'-1 WHERE Shift_Id='$Shift_Id'");
    
                                        echo "השיבוץ נמחק בהצלחה";
                                    }
                                    else 
                                    {
                                     echo "אינך רשום למשמרת עם הקוד שהוזן";
                                    }
                                }
                            }
                            /* 
                            $res = mysqli_query($conn,"SELECT User_Id FROM Waiting_List WHERE Shift_Id='$Shift_Id'");
                            while ($row = mysqli_fetch_array($res)) {
                                echo $res['User_Id'];
                            }
                            echo $res->num_rows;
                            if($Res->num_rows>0)
                            {
                              while($Row=$Res->fetch_assoc()){
                                    $SqlUser= "SELECT Email From Users WHERE username= $Row['User_Id'] ";
                                    $email = $RowUsers['Email'];
                                    $UserName =$RowUsers['FirstName'];
                                    $mail = new PHPMailer();
                                	$mail->Host = "smtp.gmail.com";
                                	$mail->SMTPSecure = "ssl";
                                	$mail->Port = 465;
                                	$mail->SMTPAuth = true;
                                	$mail->Username = 'mtalatet@gmail.com';
                                	$mail->Password = 'mtalatet2018';	
                                	$mail->setFrom('mtalatet@gmail.com', 'latet');
                                	$mail->addAddress($email);//להכניס את הכתובת ששלפתם מהדאטהבייס
                                	$mail->Subject = "Latet Replacment System";
                                	$mail->Body = "" ;
                                } 
                            }*/
                ?>
        				
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