<?php
/**
 * Created by PhpStorm.
 * User: sarahcjs
 * Date: 6/01/18
 * Time: 01:58 PM
 */

class Conexao
{
    public static $conn;

    private function __construct() {
    }

    public static function getInstance() {
        if (!isset(self::$conn)) {
            self::$conn = new PDO("sqlite:db/db.sqlite3");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, 
                        PDO::ERRMODE_EXCEPTION);
            self::setUpDatabase();
        }
        return self::$conn;
    }

    private static function setUpDatabase() {
        try {
            self::$conn->exec("CREATE TABLE IF NOT EXISTS blacklist (
                    id INTEGER PRIMARY KEY, 
                    cpf VARCHAR(11) NOT NULL,
                    status CHAR(1) DEFAULT '1', 
                    datahora_inclusao DATETIME NOT NULL,
                    datahora_alteracao DATETIME NULL)");
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
}