<?php 
class M_DB
{
    var $conn;
    function __construct()
    {
        $this->conn = new PDO("mysql:host=". HOST.";dbname=".DB, USER, PASSWORD);
        $this->conn->query('set names utf8');
    }

    protected function querySelect($sql, $arr=[])
    {
        $stm = $this->conn->prepare($sql);
        $stm->execute($arr);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function queryUpdate($sql, $arr=[])
    {
        $stm - $this->conn->prepare($sql);
        $stm->execute($arr);
        return $stm->rowCount();
    }
}