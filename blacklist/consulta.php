<?php
/**
 * Created by PhpStorm.
 * User: sarahcjs
 * Date: 6/2/18
 * Time: 1:30 AM
 */


include_once('../controller/ServerController.php');

if ($_GET && isset($_GET['cpf'])) {
    try {
        $cpf = $_GET['cpf'];
        $objServer = new ServerController();
        echo json_encode($objServer->consulta($cpf), JSON_PRETTY_PRINT);
    } catch (Exception $e) {
        $err_msg = array("status" => "error", "content" => "Houve uma falha ao completar a requisicao. ". $e->getMessage());
        echo json_encode($err_msg, JSON_PRETTY_PRINT);
    }
} else {
    $err_msg = array("status" => "error", "content" => "Inclua o parametro cpf na URL. Ex.: consulta?cpf=00000000000.");
    echo json_encode($err_msg, JSON_PRETTY_PRINT);
}

