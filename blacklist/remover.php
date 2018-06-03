<?php
/**
 * Created by PhpStorm.
 * User: sarahcjs
 * Date: 6/2/18
 * Time: 9:04 PM
 */

include_once('controller/ServerController.php');

if ($_POST && isset($_POST['cpf'])) {
    try {
        $cpf = $_POST['cpf'];
        $objServer = new ServerController();
        echo json_encode($objServer->removeFromList($cpf), JSON_PRETTY_PRINT);
    } catch (Exception $e) {
        $err_msg = array("status" => "error", "content" => "Houve uma falha ao remover o CPF. ". $e->getMessage());
        echo json_encode($err_msg, JSON_PRETTY_PRINT);
    }
} else {
    $err_msg = array("status" => "error", "content" => "Preencha o formulario com o CPF.");
    echo json_encode($err_msg, JSON_PRETTY_PRINT);
}
