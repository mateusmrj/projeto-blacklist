<?php
/**
 * Created by PhpStorm.
 * User: sarahcjs
 * Date: 5/30/18
 * Time: 11:18 PM
 */

include_once ('config/Conexao.php');

class BlacklistModel
{
    private $conn;

    function __construct() {
        $this->conn = Conexao::getInstance();
    }

    /**
     * Function that retrieves the number of active CPFs in blacklist
     * @return mixed|string
     */
    function getCount() {
        try {
            $query = "SELECT COUNT(cpf) AS QTD FROM blacklist WHERE status = 1;";
            $stmt = $this->conn->query($query);
            return json_encode($stmt->fetch(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    /**
     * Check if a CPF is considered in blacklist of not
     * @param null $cpf
     * @return string
     */
    function checkCpfStatus($cpf = null) {
        try {
            $query = "SELECT * FROM blacklist WHERE cpf = :cpf AND status = 1;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam('cpf', $cpf);
            $stmt->execute();

            $has_data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($has_data) {
                return json_encode(array('cpf' => $cpf, 'status' => 1, 'description' => 'BLOCK'), JSON_PRETTY_PRINT);
            } else {
                return json_encode(array('cpf' => $cpf, 'status' => 0, 'description' => 'FREE'), JSON_PRETTY_PRINT);
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    /**
     * Get all past appearances of a CPF in blacklist
     * @param null $cpf
     * @return string
     */
    function getCpfHistory($cpf = null) {
        try {
            $query = "SELECT cpf AS 'CPF', CASE status WHEN '0' THEN 'FREE' ELSE 'BLOCK' END AS 'Status', 
                    datahora_inclusao AS 'Data Inclusao', datahora_alteracao AS 'Data Alteracao' 
                    FROM blacklist 
                    WHERE cpf = :cpf 
                    ORDER BY datahora_inclusao DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();
            return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    /**
     * Removes CPF from blacklist setting its status to zero
     * @param $cpf
     * @return bool|string
     */
    function removeCpfFromList($cpf) {
        try {
            $query = "UPDATE blacklist SET status = 0, datahora_alteracao = datetime('now', 'localtime') WHERE cpf = :cpf AND status = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();
            return true;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    /**
     * Adds CPF to blacklist
     * @param $cpf
     * @return int|string
     */
    function addCpfToList($cpf) {
        try {
            $query = "INSERT INTO blacklist (cpf, datahora_inclusao) VALUES (:cpf, datetime('now', 'localtime'));";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();
            return true;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
}