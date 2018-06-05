<?php 
require 'phpmailer/PHPMailerAutoload.php';
?>
<!DOCTYPE HTML>
<html dir ="rtl">
    <head>
          <title>Latet</title>   
  		 <meta charset="UTF-8">
  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
  		 
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
<div class="main">

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
        $Uname=$_GET["Uname"];
        $Shift_Id=$_GET["ShiftId"];
        mysqli_set_charset($conn,"utf8");
        mysqli_query($conn,"INSERT INTO Waiting_List (User_Id, Shift_Id) VALUES ($Uname,$Shift_Id)");
        
        $Shift_Date=mysqli_query($conn,"SELECT Shift_Date FROM Shifts Where Shift_Id='$Shift_Id'");
        $Shift_Date1=mysqli_fetch_array($Shift_Date);
        $nameOfDay = date('D', strtotime($Shift_Date1['Shift_Date']));
        if($nameOfDay=="Sun"){$nameOfDay=1; }
            else if($nameOfDay=="Mon"){$nameOfDay=2;}
            else if($nameOfDay=="Tue"){$nameOfDay=3; }
            else if($nameOfDay=="Wed"){$nameOfDay=4;}
            else if($nameOfDay=="Thu"){$nameOfDay=5; }
            else if($nameOfDay=="Fri"){$nameOfDay=6; }
            else {$nameOfDay=7; }   
			
        $less= $nameOfDay-1;
        $more = 5 - $less;
        
        $start= $date-$less;
        $finish=$date+$more;
        $FirstDayOfWeek=date('Y-m-d', strtotime($Shift_Date1['Shift_Date']. ' - '. $less. 'days'));
        $EndtDayOfWeek=date('Y-m-d', strtotime($Shift_Date1['Shift_Date']. ' + '. $more. 'days'));
        
        //echo "start:" . $FirstDayOfWeek . " end" .$EndtDayOfWeek. "<br/>";
        
        $SqlRegisterVol="SELECT * FROM assignments WHERE Shift_id='$Shift_Id'"; //sql
        $ResRegisterVol = $conn->query($SqlRegisterVol); // result
        
        $SqlAvailable= "SELECT * FROM Shifts JOIN Storages ON Shifts.Storage_Id=Storages.Storage_Id WHERE Shifts.Milgaie_Quantity > Shifts.Registered_Quantity AND Shifts.Shift_Date >= '".$FirstDayOfWeek. "' AND Shifts.Shift_Date <= '".$EndtDayOfWeek. "' "; //sql
        $ShiftsAvailables = $conn->query($SqlAvailable) or die($conn->error);//result
        /* 
        $SqlUsers="SELECT * FROM Users WHERE User_Id='$Shift_Id'"; //sql
        $ResRegisterVol = $conn->query($SqlRegisterVol); // result
        */
        if ($ShiftsAvailables->num_rows > 0)
        {
            while ($RowShiftsAvailables = $ShiftsAvailables->fetch_assoc()){
                while ($RowRegisterVol = $ResRegisterVol->fetch_assoc()){
                        $DayOfWeek = 1+ date('w', strtotime($RowShiftsAvailables['Shift_Date']));
                        $User_id=$RowRegisterVol['User_Id'] ;
                        echo "<br/> ".$User_id;
                        $SqlRoutine="SELECT Routine From Personal_Constraint WHERE User_Id= '".$RowRegisterVol['User_Id']."' AND Day= '".$DayOfWeek."' ";
                        $ResRoutine = $conn->query($SqlRoutine);
                        $RowRoutine = $ResRoutine->fetch_assoc();
                        if ($RowRoutine['Routine'] =="NO"){
                            $SqlUser= "SELECT Email,FirstName From Users WHERE username= '$User_id' ";
                            $ResSqlUser = $conn->query($SqlUser);
                            $RowUsers = $ResSqlUser->fetch_assoc();
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
                        	$mail->Body =
                        	"שלום $UserName 
                        	מתנדב נוסף מעוניין במשמרת אליה נרשמת
                        	לאחר בדיקה של המערכת ישנן באותו השבוע משמרות נוספות השבוע אליהן תוכל/י להשתבץ
                        	קוד המשמרת אליה אתה רשום הוא :$Shift_Id 
                        	לשינוי השיבוץ, אנא לחץ על הקישור מטה
                        	shiranya.mtacloud.co.il/Althome.php" ;
                        	
                            if ($mail <> ""){
                            $mail->send();
                            $AtLeast1Send = true;
                            }
                    }
                }     
            }
        }
    ?>
    <div>
        <h2> נוספת בהצלחה לרשימת המתנה עבור קוד משמרת  <?php echo $Shift_Id; ?>  </h2
        <?php 
        if($AtLeast1Send)
        {
            echo "<br/> נשלחה בקשה להחלפת המשמרת <br/>";
            echo "במידה ואחד המתנדבים הרשומים יסכים לשינוי יישלח אלייך מייל בנושא";
        }
        else
        {
            echo "<br/> כרגע אין מתנדבים אליהם אפשר לשלוח בקשת החלפה <br/>";
        }
        ?>
        <!-- הוסיף לדף זה גם תאריך ויום של המשמרת-->
    </div>
    <br><br>
    <a href="http://shiranya.mtacloud.co.il/AddShift.php" style="color:#14BBB1;margin-bottom:30px"> לחזרה לעמוד קביעת משמרות</a>
    </body>
</div>
</html>