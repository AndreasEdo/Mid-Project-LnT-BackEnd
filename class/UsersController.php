<?php
require 'Users.php';

class UsersController extends Users{
    public function showUsers(){
        $results = $this->getAllUsers();
        return $results;
    }
}
?>