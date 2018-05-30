<?php 
require 'phpmailer/PHPMailerAutoload.php';

			
?>


<html>

<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
	
</head>

<body>


</body>

	
<?php

    	$mail = new PHPMailer();
    	$mail->Host = "smtp.gmail.com";
    	$mail->SMTPSecure = "ssl";
    	$mail->Port = 465;
    	$mail->SMTPAuth = true;
    	$mail->Username = 'mtalatet@gmail.com';
    	$mail->Password = 'mtalatet2018';	
    	$mail->setFrom('mtalatet@gmail.com', 'latet');
    	$mail->addAddress('adte03@gmail.com');//להכניס את הכתובת ששלפתם מהדאטהבייס
    	$mail->Subject = 'latet replace';
    	$mail->Body="שלום "."\n";
    	$mail->Body .=" המשמרת שלך הוחלפה ";
       
        	if ($mail->send())
    	 echo "Mail sent";
    	if (!$mail->send())
         echo 'mailer error: '. $mail->ErrorInfo;
		
    
?>	

</html>
