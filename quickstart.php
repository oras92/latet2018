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
  'maxResults' => 3,
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