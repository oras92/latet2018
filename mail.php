<?php
#lets first init the config
###########################
####### init Config #######
###########################

#api key and domain (from mailgun.com panel)
$secretkey='key-5a111c7a5fd388f06fc2c4767af8380c';
//source domain (you can add your own domain at mailgun panel and use it)
$domain = "sandboxddf287cd35314b2abccb6c3d4b9c298a.mailgun.org";

# email options 
$Option['FROM_MAIL']="postmaster@sandboxddf287cd35314b2abccb6c3d4b9c298a.mailgun.org";
$Option['FROM_NAME']="MyMailGun";//any name you want it to appear
$Option['TO_MAIL']="adte03@gmail.com";
$Option['TO_NAME']="Adi Tevet";
$Option['SUBJECT']="message title";
$Option['BODY_TEXT']="here is plain text message";// if html is not supported then use text message instead
$Option['BODY_HTML']="<b style='color:red'>here is html message</b>";


###########################
### Calling mailGun API ###
###########################

# Include the Autoloader
require 'vendor/autoload.php';

# Instantiate the client with option to disable ssl verfication.
$client = new \GuzzleHttp\Client([
    'verify' => false,
]);

# pass the client to Guzzle Adapter
$adapter = new \Http\Adapter\Guzzle6\Client($client);

# pass the Adapter to mailgun object
$mailgun = new \Mailgun\Mailgun($secretkey, $adapter);



# Make the call to the client.
$result = $mailgun->sendMessage($domain, array(
    'from'    => $Option['FROM_NAME']." <".$Option['FROM_MAIL'].">",
    'to'      => $Option['TO_NAME']." <".$Option['TO_MAIL'].">",
    'subject' => $Option['SUBJECT'],
    'text'    => $Option['BODY_TEXT'],
    'html'    => $Option['BODY_HTML'],
));
# result will return as object //lets test it
var_dump($result);
?>