<?php
require '../dbh/dbh.php';

class Users extends Dbh{
    protected function getAllUsers(){
        $sql = "SELECT * FROM users";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function setUser($first_name, $last_name, $email, $password, $photo, $bio) {
        $sql = "INSERT INTO users (first_name, last_name, email, password, photo, bio) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([
            $first_name,
            $last_name,
            $email, 
            $password,
            $photo, 
            $bio,
        ]);

        $this->close();
    } 

    protected function getUser($id){
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connect()->prepare($sql); 
        $stmt->execute([$id]);
        $results = $stmt->fetch(); 
        $this->close(); 
        return $results; 
    }

    protected function getUserEmail($email){
        $sql = "SELECT * FROM users WHERE email = ?"; 
        $stmt = $this->connect()->prepare($sql); 
        $stmt->execute([$email]);
        $results = $stmt->fetchAll(); 
        $this->close(); 
        return $results; 
    }

    protected function update($first_name, $last_name, $email, $password, $photo, $bio, $id) {
        $sql = "UPDATE users set first_name = ?, last_name = ?, email = ?, password = ?, photo = ?, bio = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([
            $first_name,
            $last_name,
            $email, 
            $password,
            $photo, 
            $bio,
            $id
        ]);

        $this->close();
    } 

    
    protected function delete($userId) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);

        $this->close();
    }
}
?>