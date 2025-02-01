<?php
require '../dbh/dbh.php';

class Users extends Dbh{
    protected function getAllUsers(){
        $sql = "SELECT * FROM users";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll();
        return $results;
    }
}
?>