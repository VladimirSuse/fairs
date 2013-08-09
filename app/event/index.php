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

$page_title = 'Event';
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
	$data = array(
    	'billing_contacts' => $employer->getBillingContact($_GET['id']), 
      	'emp_contacts' => $employer->getDirectContact($_GET['id']), 
      	'emp_info' => $employer->getAllEmployer($_GET['id'])
    );
	echo json_encode($data);

} elseif ($_GET['page'] == "notRegisteredList") {
	$data = $employer -> getEmployerWithoutEvent($_GET['id']);
	echo json_encode($data);
} elseif ($_GET['page'] == "registeredList") {
	$data = $employer -> getEventRegistrationEvent($_GET['id']);
	echo json_encode($data);
}elseif ($_GET['page'] == "registerEmployer") {
	$data = array(
		'career_employer_id' => $_POST['employer_id'],
		'career_employer_event_id' => $_POST['event_id'],
		'career_employer_event_service_id' => $_POST['service_id']
	);

	$returned = $employer -> saveEventRegistrations($data);
	echo $returned;

} else {
    require_once '../../includes/php/error.php';
}
