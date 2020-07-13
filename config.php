<?php
     session_start();
     require_once 'GoogleAPI/vendor/autoload.php';

     $gClient = new Google_Client();
     // setup api at console.developers.google.com
     $gClient->setClientId("Enter your generated client ID");
     $gClient->setClientSecret("Enter your generated client secret key");
     $gClient->setApplicationName("Secure Data Deduplication");
     $gClient->setRedirectUri("http://localhost/SecureDataDeduplication/g-callback.php");

     // access permission from users
     $gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
