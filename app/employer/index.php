<?php

session_start();

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');

// Load the model
require 'model.php';
$equip = new Cpu();

$page_title = 'Computers';
$icon = "icon-drive";

// Load the page requrested by the user
if (!isset($_GET['page'])) {
    // Set the necessary variables for the template
    $js_path = "cpu.js";

    if (isset($_GET['showDiscarded']) && $_GET['showDiscarded'] === '1') {
        $discard_variable = 'Hide';
        $equip->showDiscarded = true;
        $discard_url = 'index.php';
    } else {
        $discard_variable = 'Show';
        $equip->showDiscarded = false;
        $discard_url = 'index.php?showDiscarded=1';
    }

    $data = $equip->listItems();
    $lists = array( 'employees' => $equip->listEmployees(),
                    'departments' => $equip->listDepartments(),
                    'makes' => $equip->listMakes(),
                    'tags' => $equip->listAllTags(),
                    'statuses' => $equip->listStatuses());

    require '../template/table-card-view.php';
} else if ($_GET['page'] == 'edit') {
    //determine if item is already in database or not
    try {
        $equip->editItem($_POST);
        $equip->remapTags('sass_equip_cpu', (int) $_POST['cpu_id'], $_POST['tag_id']);
        require 'table.php';
        $items = $equip->listItems($_POST['cpu_id']);
        generateRow($items[0], $equip);
    } 
    catch (PDOException $e) {
        header('HTTP/1.0 400 Bad Request', 400);
        header('Content-Type: text/plain');
        echo $e->getMessage();
    }
} else if ($_GET['page'] == 'add') {
     try {
        $equip->addItem($_POST);
        $equip->createTags('sass_equip_cpu', $_POST['tag_id'], 'cpu_id'); 
        header('location:index.php');
    } catch (PDOException $e) {
        header('HTTP/1.0 400 Bad Request', 400);
        header('Content-Type: text/plain');
        echo $e->getMessage();
    }
} else if ($_GET['page'] == 'bulk') { //Bulk Add
    try {
        $equip->addItem($_POST);
        $equip->createTags('sass_equip_cpu', $_POST['tag_id'], 'cpu_id'); 
        echo $equip->lastEntry();
    } catch (PDOException $e) {
        header('HTTP/1.0 400 Bad Request', 400);
        header('Content-Type: text/plain');
        echo $e->getMessage();
    }
} else if ($_GET['page'] == 'card') {
    $lists = array( 'employees' => $equip->listEmployees(),
                    'departments' => $equip->listDepartments(),
                    'makes' => $equip->listMakes(),
                    'tags' => $equip->listAllTags(),
                    'statuses' => $equip->listStatuses());
    
    require 'table.php';
    
    if (isset($_GET['id'])) {
        $equip->showDiscarded = true;
        $data = $equip->listItems($_GET['id']);
        generateCard($data[0], $lists, $icon);
       
    } else {
        generateCard(array(), $lists, $icon);
    }
} else if ($_GET['page'] == 'csv') {
    require '../../utils/csv.php';

    if (isset($_GET['discarded']) && $_GET['discarded'] === '1') {
        $equip->showDiscarded = true;
    }

    if ($data = $equip->csvListItems()) {
        $output = new CSV($data);
        $output->generate();
    }
} else {
    require '../../utils/error.php';
}