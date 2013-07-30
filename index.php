<?php

//============================================================================================
// Enable Error Reporting
//============================================================================================
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');
//============================================================================================
// Control the flow of the application
//============================================================================================
if (!isset($_GET['page'])) {
    // //Is the user within the available zone?
    // $visitIP = explode('.', $_SERVER['HTTP_X_FORWARDED_FOR']);
    // if ($visitIP[0] . '.' . $visitIP[1] !== "137.122") {
        // die('<div style="text-align:center; font-size:1.5em; font-family: Segoe UI, Arial; margin-top: 2em;">Indicium is accessible only on campus at uOttawa. If you are off-campus, you may VPN in to the universities network.</div>');
    // }
// 
    // header('Location: https://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'] . 'app/cpu/');

    //Is the user within the available zone?
    // $visitIP = explode('.', $_SERVER['HTTP_X_FORWARDED_FOR']);
    // if ($visitIP[0] . '.' . $visitIP[1] !== "137.122") {
    //     die('<div style="text-align:center; font-size:1.5em; font-family: Segoe UI, Arial; margin-top: 2em;">Indicium is accessible only on campus at uOttawa. If you are off-campus, you may VPN in to the universities network.</div>');
    // }

    // header('Location: https://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'] . 'mis/');

    header('Location:app/cpu/');
    
} else if ($_GET['page'] === "unauthorized") {

    //Case where someone is trying to access a URL that they don't the the permissions to
    echo '<div style="text-align:center; font-size:1.5em; font-family: Segoe UI, Arial; margin-top: 2em;">You do not have permission to view that page. <br>If you think you should be able to access this page please contact the SASS IT team.</div>';
} else {

    //Anything else is an error
    header('location:includes/php/error.php');
}