<!DOCTYPE html>
<html dir="rtl">
<head>
<title> לתת </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;width: 70%;margin:0px auto; }
form {border: 3px solid #f1f1f1;}

input[type=password], input[type=username] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #3cb6b0;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.latet {
    width: 15%;
    border: 70%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
</head>
<body>
<?php
ob_start();
session_start();
$_SESSION['username']=$_POST['username'];
mysql_connect("Localhost","shiranya_adte03","adte1205") or die ("No Connection");
mysql_select_db("shiranya_Latet2018") or die ("No Database Name");
$error="";
if (isset($_POST['btn_log']))
{
    if (empty($_POST['username'])|| empty($_POST['password']))
    {
        $error= "Both fields required";
    }
    else
    {
        $error ="!Username or Password Wrong";
        $Uname=($_POST['username']);
        $Pass=($_POST['password']);
        $sql=mysql_query("SELECT * FROM Users WHERE username='$Uname' AND password='$Pass'");
        $cout=mysql_num_rows($sql);
        if ($cout > 0)
        header ('location:home.html');
    }
}
ob_end_flush();
mysql_set_charset("utf8");
?>
<form action="index.php" method="post">
  <div class="imgcontainer">
    <img src="/img/latet_logo.jpg" alt="latet" class="latet">
  </div>

  <div class="container">
    <label for="uname"><b>שם משתמש</b></label>
    <input type="username" placeholder=" הקלד שם משתמש "  name="username" >
    <label for="psw"><b>סיסמא</b></label>
    <input type="password" placeholder="הקלד סיסמא"  name="password" >
        
    <button type="submit" name="btn_log">התחבר</button>
  </div>
       <div class="error" style="color:red; text-align:center"> <?php echo $error; ?></div>
  <div class="container" style="background-color:#f1f1f1">
  <center> <button type="reset" class="cancelbtn">ביטול</button> </center>
  </div>
</form>
</body>
</html>