<?php
    include 'config.php';

    // this code only works for google logout, find solution for simple logout
    // if(isset($_SESSION['googleSsoFlag']))
    // {
    //     unset($_SESSION['access_token']);
    //     $gClient->revokeToken();
    //     session_destroy();
    // }
    // else
    // {
    //     session_destroy();
    // }

    unset($_SESSION['access_token']);
    $gClient->revokeToken();
    session_destroy();
    header('location:login.php');
    exit();
?>
