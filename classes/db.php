<?php

class Db{
    private $dsn = "mysql:host=localhost;dbname=test";
    private $user = "root";
    private $pass = "";
    private $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    );

    protected $dbCon;
    public function __construct(){
        try{
            $this->dbCon = new PDO($this->dsn , $this->user , $this->pass , $this->options);
            $this->dbCon->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function dbConnect(){
        return $this->dbCon;
    }
}