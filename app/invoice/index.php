<?php

session_start();

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');

//============================================================================================
// MODEL 
//============================================================================================
require_once '../../includes/Employer.php';
$employer = new Employer();

$page_title = 'Invoices';
$icon = "icon-doc-text";
$js_path = "invoice.js";

//============================================================================================
// Load the page requested by the user
//============================================================================================

if (!isset($_GET['page'])) {
    $data = $employer -> getInvoice();
    require_once '../template/template.php';
} elseif ($_GET['page'] == "card") {
	# code...
} elseif ($_GET['page'] == "edit") {
	# code...
} elseif ($_GET['page'] == "add") {
	# code...
} elseif ($_GET['page'] == "contact") {
	# action = add/del or edit
} else {
    require_once '../../includes/php/error.php';
}
