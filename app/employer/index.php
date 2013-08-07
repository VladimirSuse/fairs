<?php

session_start();

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');

//============================================================================================
// MODEL 
//============================================================================================
require_once '../../includes/Employer.php';
$employer = new Employer();

$page_title = 'Employers';
$icon = "icon-user";
$js_path = "employer.js";

//============================================================================================
// Load the page requested by the user
//============================================================================================

if (!isset($_GET['page'])) {
    $data = $employer -> getAllEmployer();
    require_once '../template/template.php';
} elseif ($_GET['page'] == "card") {
	$data = array(
				  	'billing_contacts' => $employer->getBillingContact($_POST['id']), 
		          	'emp_contacts' => $employer->getDirectContact($_POST['id']), 
		          	'events' => $employer -> getEventRegistrationEmployer($_POST['id']),
		          	'emp_info' => $employer->getAllEmployer($_POST['id'])
		         );
	echo json_encode($data);

} elseif ($_GET['page'] == "add-edit-employer") {
	//edit case
	if(!empty($_POST['id'])){
			echo ($affectedRows = $employer->updateEmployer($_POST, $_POST['id']) > 0 ? json_encode(array('type' => 'update','success' => 'true')) : json_encode(array('type' => 'update','success' => 'false')));
	}
	else{
		$id = $employer->saveEmployer($_POST);
		if(!is_null($id))
			echo json_encode(array('type' => 'add','emp_info' => $employer->getAllEmployer($id)));
	}	
} elseif ($_GET['page'] == "add-edit-contact") {
	//edit case
	if(!empty($_POST['id'])){
		echo ($affectedRows = $employer->updateContactDetail($_POST, $_POST['id']) > 0 ? json_encode(array('type' => 'update','success' => 'true')) : json_encode(array('type' => 'update','success' => 'false')));
	}
	else{
		$id = $employer->saveDirectContact($_POST, $_POST['id']);
		if(!is_null($id))
			echo json_encode(array('type' => 'add','contact_info' => $employer->getDirectContact($id)));
	}	
} elseif ($_GET['page'] == "contact") {
	# action = add/del or edit
} else {
    require_once '../../includes/php/error.php';
}
