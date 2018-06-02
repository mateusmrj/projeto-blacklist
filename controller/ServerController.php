<?php
/**
 * Created by PhpStorm.
 * User: sarahcjs
 * Date: 5/30/18
 * Time: 11:15 PM
 */

include_once ('../model/BlacklistModel.php');
include_once ('../model/LogsModel.php');

class ServerController
{
    private $objBlacklist = null;

    function __construct()
    {
        $this->objBlacklist = new BlacklistModel();
        $this->objLog = new LogsModel();
    }

    function consulta($cpf) {
        $clean_cpf = $this->sanitizeCpf($cpf);
        $this->objLog->register();
        return $this->objBlacklist->checkCpfStatus($clean_cpf);
    }

    function status() {
        $log = $this->objLog->getCount();

        if (isset($log['status']) && $log['status'] == "error") {
            return $log;
        }

        $blacklist = $this->objBlacklist->getCount();

        if (isset($blacklist['status']) && $blacklist['status'] == "error") {
            return $blacklist;
        }

        return array("Qtd. Consultas: " => $log['QTD'],
        "Qtd. na Blacklist: " => $blacklist['QTD']);
    }

    function sanitizeCpf($cpf) {
        $clean_cpf = strip_tags(htmlentities($cpf));
        $clean_cpf = preg_replace("/\D+/", "", $clean_cpf);
        return str_pad($clean_cpf, 11, "0", STR_PAD_LEFT);
    }

    function addToList($cpf) {
        $clean_cpf = $this->sanitizeCpf($cpf);
        $check = $this->consulta($clean_cpf);
        
        if ($check["status"] == 0) {
            return $this->objBlacklist->addCpfToList($clean_cpf);
        } else {
            return array("status" => "success", "content" => "O CPF já estava na Blacklist.");
        }
    }

    function removeFromList($cpf) {
        $clean_cpf = $this->sanitizeCpf($cpf);
        $check = $this->consulta($clean_cpf);
        
        if ($check["status"] == 1) {
            return $this->objBlacklist->removeCpfFromList($clean_cpf);
        } else {
            return array("status" => "success", "content" => "O CPF já estava fora da Blacklist.");
        }
    }

    function getHistory($cpf) {
        $clean_cpf = $this->sanitizeCpf($cpf);
        return $this->objBlacklist->getCpfHistory($clean_cpf);
    }
}