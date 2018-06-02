<?php

include_once ('../config/Conexao.php');

class LogsModel
{
    private $conn;

    function __construct() {
        $this->conn = Conexao::getInstance();
    }

    /**
     * Function that retrieves the number of searches done
     * @return mixed|string
     */
    function getCount() {
        try {
            $query = "SELECT COUNT(id) AS QTD FROM log WHERE acao = 'consulta';";
            $stmt = $this->conn->query($query);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            return array("status" => "error", "content" => "Houve uma falha ao buscar a quantidade de consultas realizadas. ". $exc->getMessage());
        }
    }

    /**
     * Adds action to log
     * @param $acao
     * @return int|string
     */
    function register($acao = null) {
        try {
            $query = "INSERT INTO log (acao, datahora_inclusao) VALUES (:acao, datetime('now', 'localtime'));";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':acao', $acao);
            $stmt->execute();
            return array("status" => "success", "content" => "Registro de log adicionado.");
        } catch (PDOException $exc) {
            return array("status" => "error", "content" => "Houve uma falha ao adicionar o registro de log. ". $exc->getMessage());
        }
    }
}