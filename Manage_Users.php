<!DOCTYPE HTML>
<html dir ="rtl">
    <head>
          <title>Latet</title>   
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
            <a href="http://shiranya.mtacloud.co.il/home_admin.php"><img src="/img/LOGO.jpeg" alt="latet" ;width="120" height="120"></a>
        </div>
		 <nav class="topnav" id="myTopnav">
           <ul id="navbar">
		   <li><a href="javascript:void(0);" class="icon" onclick="myFunction()">תפריט</a></li>
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

    <h3> הוספת משתמש חדש למערכת</h3>
       <form id="Add_User" action="Manage_Users.php" method="post">
            הזן ת.ז. מתנדב <br>(ישמש כשם משתמש) <input type="number" name="UserName"></input>
            <br/><br/>
            <p>הזן סיסמא <input type="password" name="Password"></input></p>
            <p>שם פרטי <input type="text" name="FirstName"></input></p>
            <p>שם משפחה <input type="text" name="LastName"></input></p>
            <p>כתובת דואר אלקטרוני <input type="email" name="Email"></input></p>
            <p>מס' טלפון <input type="text" name="MobilePhone"></input></p>
            <p>תאריך לידה <input type="date" name="Birthday"></input></p>
            <p><lable> בחר הרשאות:
                <select name="Premission" size="1">
                    <option value="--בחר--"> --בחר-- </option>
                    <option value="admin"> admin </option>
                    <option value="Volunteer"> Volunteer </option>
                </select>
           </lable></p>
            <input type="submit" name="AddUser" value="לחץ להוספת משתמש חדש"> </input>
            </form>
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
        $error="";
        if (isset($_POST['AddUser'])){
            if (empty($_POST['UserName'])||empty($_POST['Password'])||empty($_POST['FirstName'])||empty($_POST['LastName'])||empty($_POST['Email'])||empty($_POST['MobilePhone'])||empty($_POST['Birthday'])||empty($_POST['Premission'])){
                $error="חובה להזין את כל השדות";
            }
            else
            {
                $username=$_POST['UserName'];
                $pass=$_POST['Password'];  
                $first=$_POST['FirstName'];
                $last=$_POST['LastName'];
                $mail=$_POST['Email'];
                $mobile=$_POST['MobilePhone'];
                $birth=$_POST['Birthday'];
                $premmision=$_POST['Premission'];
                mysqli_query($conn,"INSERT INTO Users(username, password, FirstName, LastName,MobilePhone, Email, Birthday,Job) VALUES ($username, $pass,'$first','$last',$mobile,'$mail','$birth','$premmision')");
                // echo "משתמש חדש נוסף בהצלחה";
            }
        }
?>  
<div class="error" style="color:red; text-align:right; font-size:36px"> <?php echo $error; ?></div>
<br/>
    <h3> מחיקת משתמש קיים</h3>
       <form id="Delete_User" action="Manage_Users.php" method="post">
        <p> </p>שם משתמש למחיקה <input type="number" name="UserName"></input> <br/></p>
        <input type="submit" name="DeleteUser" value="לחץ למחיקת משתמש"> </input>
        </form>
        <?php
        if(isset($_POST['DeleteUser'])){
        $Uname=$_POST['UserName'];
            if(!empty($Uname)){
                $sql321 = "SELECT * FROM Users WHERE username='$Uname'";
                $result = $conn->query($sql321);
                if($result -> num_rows >0) {
                    mysqli_query($conn,"DELETE FROM `Users` WHERE username='$Uname'");
                    echo "מחיקת משתמש הושלמה";
                }
                else
                {
                    echo"שם המשתמש שהוזן לא קיים מערכת";
                }
            }
            else{
                echo "לא הוזנו נתונים";
            }
        }
        ?>
       
</div>
 <br>         <br>        <br>        <br>
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