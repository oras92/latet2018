 <!DOCTYPE HTML>
<head>
  		 <TITLE>Latet</TITLE>   
  		 <meta charset="UTF-8">
  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
  		  		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<html dir="rtl">
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
   
      <H1 style="text-align:center;"><i style="font-size:24px" class="fa">&#xf02e;</i> המשמרות שלי </H1>
      
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
    
   $sql2= "SELECT User_Id, Shift_Date, Storage_Id FROM assignments where User_Id ='" .$_SESSION['username'] ."'";
           $result = $conn->query($sql2);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ת.ז מתנדב</th><th>תאריך משמרת</th> <th>מספר מחסן</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["User_Id"]. "</td><td>" . $row["Shift_Date"]. " </td><td>" . $row["Storage_Id"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
    
?>


</body>

	<?php
require_once __DIR__.'/vendor/autoload.php';
/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
    $client->setAuthConfig('client_secret.json');
    $client->setAccessType('offline');

    // Load previously authorized credentials from a file.
    $credentialsPath = expandHomeDirectory('credentials.json');
    if (file_exists($credentialsPath)) {
        $accessToken = json_decode(file_get_contents($credentialsPath), true);
    } else {
        // Request authorization from the user.
        $authUrl = $client->createAuthUrl();
        printf("Open the following link in your browser:\n%s\n", $authUrl);
        print 'Enter verification code: ';
        $authCode = trim(fgets(STDIN));

        // Exchange authorization code for an access token.
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

        // Store the credentials to disk.
        if (!file_exists(dirname($credentialsPath))) {
            mkdir(dirname($credentialsPath), 0700, true);
        }
        file_put_contents($credentialsPath, json_encode($accessToken));
        printf("Credentials saved to %s\n", $credentialsPath);
    }
    $client->setAccessToken($accessToken);

    // Refresh the token if it's expired.
    if ($client->isAccessTokenExpired()) {
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

/**
 * Expands the home directory alias '~' to the full path.
 * @param string $path the path to expand.
 * @return string the expanded path.
 */
function expandHomeDirectory($path)
{
    $homeDirectory = getenv('HOME');
    if (empty($homeDirectory)) {
        $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
    }
    return str_replace('~', realpath($homeDirectory), $path);
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
  'maxResults' => 10,
  'orderBy' => 'startTime',
  'singleEvents' => true,
  'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);

if (empty($results->getItems())) {
    print "No upcoming events found.\n";
} else {
    print "Upcoming events:\n";
    foreach ($results->getItems() as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        printf("%s (%s)\n", $event->getSummary(), $start);
    }
}


//require_once __DIR__.'/vendor/autoload.php';
//session_start();
//$client = new Google_Client();
//$client->setAuthConfig('client_secret.json');
//$client->addScope(Google_Service_Calendar::CALENDAR_READONLY);
//if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
//  $client->setAccessToken($_SESSION['access_token']);
//  // Print the next 10 events on the user's calendar.
//  $calendarId = 'primary';
//  $optParams = array(
//    'maxResults' => 10,
//    'orderBy' => 'startTime',
//    'singleEvents' => TRUE,
//    'timeMin' => date('c'),
//  );
//  
//  $service = new Google_Service_Calendar($client);
//  $results = $service->events->listEvents($calendarId, $optParams);
//  if (count($results->getItems()) == 0) {
//    print "No upcoming events found.\n";
//  } else {
//    print "Upcoming events:\n";
//    foreach ($results->getItems() as $event) {
//      $start = $event->start->dateTime;
//      if (empty($start)) {
//        $start = $event->start->date;
//      }
//      printf("%s (%s)\n", $event->getSummary(), $start);
//    }
//  }
//} else {
//  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php';
//  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
//}
?>

 </html>
