<?php
    require_once 'config.php';

    if(isset($_SESSION['access_token']))
        $gClient->setAccessToken($_SESSION['access_token']);

    else if (isset($_GET['code']))
    {
        $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
        $_SESSION['access_token'] = $token;
    }
    else
    {
        header('location: login.php');
        exit();
    }

    $oAuth = new Google_Service_Oauth2($gClient);
    $userData = $oAuth->userinfo_v2_me->get(); // method stores json data into $userData

    // this requires the certificate, according to 'php.ini' file, [curl] and [openssl] path given
    // if you dont have certificate in that path, check for this path  'C:\xampp\perl\vendor\lib\Mozilla\CA\' and
    // if you have at that path give that path in php.ini file, restart apache service and try again.
    
    // var_dump($userData)
    $_SESSION['id'] = $userData['id'];
    $_SESSION['email'] = $userData['email'];
    // $_SESSION['gender'] = $userData['gender'];
    $_SESSION['picture'] = $userData['picture'];
    $_SESSION['lastName'] = $userData['familyName'];
    $_SESSION['firstName'] = $userData['givenName'];
    $_SESSION['username'] = $userData['givenName'] . ' ' . $userData['familyName'];
    // $flag = 1;
    // $_SESSION['googleSsoFlag'] = $flag;

    header('location: index.php');
    exit();
?>
