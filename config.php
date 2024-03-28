<?php
require_once 'vendor/autoload.php';

// Google API configuration
define('GOOGLE_CLIENT_ID','');
define('GOOGLE_CLIENT_SECRET','');
define('GOOGLE_REDIRECT_URL','');

// start session
if(!session_id()){
    session_start();
}

// call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to AxelTest');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Service_Oauth2($gClient);

?>