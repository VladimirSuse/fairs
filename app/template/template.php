<?php
session_start();

// Check if the user is logged into the intranet
if (!isset($_SESSION["uid"]) || !is_numeric($_SESSION["uid"])) {
    //header("Location: https://" . $_SERVER["SERVER_NAME"] . "/sass/index.php?xaction=timeout");
}

header('Content-Type: text/html; charset=utf-8');
// ob_start('ob_gzhandler');

header('Content-Language: en-CA');

include 'view.php';
?>
<!DOCTYPE html>
<html lang='en-CA'>
    <head>
        <meta charset='utf-8'> 
        <title>Career Fairs - <?= $page_title; ?></title>

        <link rel="stylesheet" media="screen" type="text/css" href="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
        <link rel="stylesheet" media="screen" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/chosen/0.9.14/chosen.min.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <!-- <link rel="stylesheet" media="screen" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jquery-powertip/1.2.0/css/jquery.powertip-blue.min.css"> --> 
        <!-- <link type="text/css" href="../../cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8"> -->
        <link rel="stylesheet" href="../../css/gumby.css">
        <link rel="stylesheet" href="../../css/style.css">
        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.4/jquery-editable/css/jquery-editable.css" rel="stylesheet">

    </head>
    <body>
        <header class="container header">
            <div class="row">
                <!-- <img src="../../img/mis_indicium_logo_dark.png"> -->
                <h1>Career Fairs Needs a Logo</h1>
            </div>
            <div id="message">
                <p class="success alert"></p>
            </div>
        </header>
        <div class="container navbar">
            <div class="row">
                <a class="toggle" gumby-trigger="#nav1 > .row > ul" href="#"><i class="icon-menu"></i></a>
                <ul class="sixteen columns">
                    <li><a href="../employer/">Employers</a></li>
                    <li><a href="../event/">Events</a></li>
                    <li><a href="../service/">Services</a></li>
                    <li><a href="../invoice/">Invoices</a></li>
                </ul>
            </div>
        </div>
        <div class="container content">
            <div class="row">
                <div class="five columns" id="left-panel">
                    <div class="row">
                        <div class="seven columns">
                            <h2 id="pageTitle"><i class="<?= $icon ?>"></i> <?= $page_title; ?>s</h2>
                        </div>
                        <div class="nine columns" style="text-align: right; padding-top: 20px;">
                            <div class="small btn secondary metro"><input id="add-btn" type="submit" value="Add New <?= $page_title; ?>"></div>                        
                        </div>
                    </div>
                    <?php 

                        switch($page_title) {

                            case "Employers": 
                                require "template-employer.php";
                                break;
                            case "Event": 
                                require "template-event.php";
                                break;

                            case "Services": 
                                require "template-service.php";
                                break;

                            case "Invoices": 
                                require "template-invoice.php";
                                break;

                        }

                    ?>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <footer>Designed &amp; Developed by Student Academic Success Service, <?= date('Y'); ?>.</footer>
            </div>
        </div>
    </body>

        <script src="../../js/libs/modernizr-2.6.2.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js" charset="utf-8"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.js" charset="utf-8"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" charset="utf-8"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js" charset="utf-8"></script>
        <script src='//cdnjs.cloudflare.com/ajax/libs/chosen/0.9.14/chosen.jquery.min.js' charset="utf-8"></script>
        <!-- <script src='//cdnjs.cloudflare.com/ajax/libs/jquery-powertip/1.2.0/jquery.powertip.min.js' charset="utf-8"></script> -->
        <script src="//cdn.jsdelivr.net/cleditor/1.3.0/jquery.cleditor.min.js" charset="utf-8"></script>
        <script src="../../js/libs/gumby.min.js"></script>
         <!-- <script src="../../js/libs/spin.js"></script> -->
        <script src="../../js/plugins.js"></script>
        <script src="../../js/<?= $js_path ?>"></script>
        <script src="../../js/template.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.4/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
        <!-- <script async src="../../../cometchat/cometchatjs.php" charset="utf-8"></script> -->
</html>