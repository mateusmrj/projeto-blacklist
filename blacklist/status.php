<?php
/**
 * Created by PhpStorm.
 * User: sarahcjs
 * Date: 6/2/18
 * Time: 1:29 AM
 */

include_once('../controller/ServerController.php');
header('Content-Type: application/json; charset=utf-8');

$objServer = new ServerController();
echo json_encode($objServer->status(), JSON_PRETTY_PRINT);