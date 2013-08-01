<?php

session_start();

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');

//============================================================================================
// MODEL 
//============================================================================================
require_once '../../includes/Employer.php';
$employer = new Employer();

$page_title = 'Events';
$icon = "icon-globe";
$js_path = "event.js";

//============================================================================================
// Load the page requested by the user
//============================================================================================

if (!isset($_GET['page'])) {
    $data = $employer -> getEvent();
    require_once '../template/template.php';
} elseif ($_GET['page'] == "card") {
	require 'view.php';
	$data = $employer -> getEvent($_GET['id']);
	generateCard($data[0]);
} elseif ($_GET['page'] == "edit") {
	try {
		 $lastid = $employer->updateEvent($_POST, $_POST['id']);
		 echo $lastid;
	} catch (Exception $e){
        header('HTTP/1.0 400 Bad Request', 400);
        header('Content-Type: text/plain');
        echo $e->getMessage();
	}
} elseif ($_GET['page'] == "add") {
	try {
		echo $employer->saveEvent($_POST);
	} catch (Exception $e){
        header('HTTP/1.0 400 Bad Request', 400);
        header('Content-Type: text/plain');
        echo $e->getMessage();
	}
} else {
    require_once '../../includes/php/error.php';
}
