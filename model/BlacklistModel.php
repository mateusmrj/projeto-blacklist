<?php
/**
 * Created by PhpStorm.
 * User: sarahcjs
 * Date: 5/30/18
 * Time: 11:18 PM
 */

class BlacklistModel
{
    private $conn = null;

    function __construct() {
        try {
            $this->conn = new PDO("sqlite: db.sqlite3");
        } catch (PDOException $exc) {
            return $exc->getMessage();
        }
    }

    function getCount() {
        try {
            $query = "SELECT COUNT(cpf) AS QTD FROM blacklist WHERE status = 1;";
            $stmt = $this->conn->query($query);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            return $exc->getMessage();
        }
    }

    function checkStatus($cpf = null) {
        try {
            $query = "SELECT * FROM blacklist WHERE cpf = :cpf AND status = 1;";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['cpf' => $cpf]);

            $has_data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($has_data) {
                return json_encode(array('cpf' => $cpf, 'status' => 'BLOCK'));
            } else {
                return json_encode(array('cpf' => $cpf, 'status' => 'FREE'));
            }
        } catch (PDOException $exc) {
            return $exc->getMessage();
        }
    }

    function getHistory($cpf = null) {
        try {
            $query = "SELECT * FROM blacklist WHERE cpf = :cpf ORDER BY datahora_inclusao DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['cpf' => $cpf]);

            return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $exc) {
            return $exc->getMessage();
        }
    }

    function removeFromList($cpf) {
        try {
            $query = "UPDATE blacklist SET status = 0, datahora_alteracao = datetime('now', 'localtime') WHERE cpf = :cpf AND status = 1";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute(['cpf' => $cpf]);
        } catch (PDOException $exc) {
            return $exc->getMessage();
        }
    }

    function addToList($cpf) {
        try {
            $query = "INSERT INTO blacklist (cpf, datahora_inclusao) VALUES (:cpf, datetime('now', 'localtime'));";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['cpf' => $cpf]);
            return $this->conn->lastInsertId();
        } catch (PDOException $exc) {
            return $exc->getMessage();
        }
    }
}