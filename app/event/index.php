<?php

session_start();

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');

//============================================================================================
// MODEL 
//============================================================================================
require_once '../../includes/Employer.php';
require '../employer/view.php';
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

	$info = array(
		"event" => $employer -> getEvent($_GET['id']),
		"employers" => $employer -> getEventRegistrationEvent($_GET['id'])
		);
	echo json_encode($info);
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
} elseif ($_GET['page'] == "employer") {
	require '../employer/view.php';
	$allEmp = $employer -> getAllEmployer();
	$relEmp = $employer -> getEventRegistrationEvent($_GET['id']);
	generateEmployerCard($data[0]);
} elseif ($_GET['page'] == "contact") {
	require '../employer/view.php';
	$contacts = $employer -> getDirectContact($_GET['id']);
	generateContactCard($data[0]);
} else {
    require_once '../../includes/php/error.php';
}
