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
	# code...
} elseif ($_GET['page'] == "add-edit") {
	$data = array("org_name_en" => $_POST['org_name_en'], "org_name_fr" => $_POST['org_name_fr'],"dep_name_en" => $_POST['dep_name_en'], "dep_name_fr" => $_POST['dep_name_fr'], "website_en" => $_POST['website_en'], "website_fr" => $_POST['website_fr'], "hst_exempt" => $_POST['hst_exempt'], "pst_exempt" => $_POST['pst_exempt']);
	//edit case
	if(!empty($_POST['id'])){
		$employer->updateEmployer($data,$_POST['id']);
	}
	else{
		$employer->saveEmployer($data);
	}
} elseif ($_GET['page'] == "contact") {
	# action = add/del or edit
} else {
    require_once '../../includes/php/error.php';
}
