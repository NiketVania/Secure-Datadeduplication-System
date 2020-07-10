<?php
     session_start();
     require_once 'GoogleAPI/vendor/autoload.php';

     $gClient = new Google_Client();
     // setup api at console.developers.google.com
     $gClient->setClientId("378862440789-9niv0uioml4799cj1ja42qdjm3t8r1jb.apps.googleusercontent.com");
     $gClient->setClientSecret("chtmFDYaC-kZ61l08DGOfy4r");
     $gClient->setApplicationName("Secure Data Deduplication");
     $gClient->setRedirectUri("http://localhost/SecureDataDeduplication/g-callback.php");

     // access permission from users
     $gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
