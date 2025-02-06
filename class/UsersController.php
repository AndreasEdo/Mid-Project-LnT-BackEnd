<?php
require 'Users.php';

class UsersController extends Users{

    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $photo; 
    private $bio; 

    private function user($data) {
        $this->first_name = $data['firstName'];
        $this->last_name = $data['lastName'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->bio = $data['bio'];

        if (isset($data['pass']) && !empty($data['pass'])) {
            $this->password = $data['pass'];  
        } else {
            
            $this->password = isset($data['password']) ? $data['password'] : '';
        }
    }

    public function showUsers(){
        $results = $this->getAllUsers();
        return $results;
    }

    public function getOneUser($id) {
        $results = $this->getUser($id);
    
        
        if ($results === false) {
            die('User not found');
        }
    
        return $results;
    }

    public function updateUser($old_data, $data, $img) {
        $this->user($data); 
    
        $result = $this->validateInput(false);
        $this->photo = $old_data['photo'];
        
        if (empty($data['password'])) {
            $this->password = isset($old_data['password']) ? $old_data['password'] : '';  
        } else {
            
            $this->password = password_hash($data['password'], PASSWORD_DEFAULT);
        }
  
        if (!empty($img['tmp_name'])) {
            $photoPath = realpath('../img/' . $old_data['photo']);
    
            if ($photoPath && file_exists($photoPath)) {
                unlink($photoPath);
            }
    
            move_uploaded_file($img['tmp_name'], '../img/' . $img['name']);
            $this->photo = $img['name'];
        }
    


    
        if ($result === true) {
            $this->update(
                $this->first_name,
                $this->last_name, 
                $this->email, 
                $this->password, 
                $this->photo,
                $this->bio,
                $old_data['id']
            );
        }
    

    }
    
    
    private function validateInput($checkDupEmail = true){
        if($this->isNotEmptyInput() === false){
            header("Location: dashboard.php?error=empty");
            exit();
        }
        else if($this->isEmail() === false){
            header("Location: dashboard.php?error=emailInvalid");
            exit();
        }
        
        else if($checkDupEmail && $this->duplicateEmail() === false){
            header("Location: dashboard.php?error=dupemail");
            exit();
        }

        return true;
    }

    private function duplicateEmail(){
        $result = true;
        $count = $this->getUserEmail($this->email);
        if(count($count) > 0){
            $result = false;
        }

        return $result;
    }

    private function isNotEmptyInput() {
        if (
            empty($this->first_name) || 
            empty($this->last_name)  || 
            empty($this->email) || 
            empty($this->bio)
        ) {
            return false; 
        }
        
        return true;
    }
    

    private function isEmail() {
        $result = true;
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL) === false){
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }


}
?>