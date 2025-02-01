<?php

class Dbh{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbName = 'midprojectbncc';
    private $pdo;

    protected function connect(){
        $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
        try{
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
    
        catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
        return $this->pdo;
    }

    protected function close(){
        $this->pdo = null;
    }

}