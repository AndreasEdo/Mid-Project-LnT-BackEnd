<?php
require_once 'Users.php';

class LoginController extends Users {

    private $email;
    private $password;

    private function user($data) {
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
    }

    public function login($data) {
        $this->user($data);

        if ($this->validateInput()) {
            session_start();
            $_SESSION['login'] = true;
            header("Location: ../view/dashboard.php");
            exit();
        }
    }

    private function validateInput() {
        if (!$this->isNotEmptyInput()) {
            header("Location: ../view/login.php?error=empty");
            exit();
        }

        if (!$this->isEmail()) {
            header("Location: ../view/login.php?error=emailInvalid");
            exit();
        }

        $user = $this->getUserEmail($this->email);
        
        if (!$user || count($user) < 1) {
            header("Location: ../view/login.php?error=invalidEmail");
            exit();
        }

        $user = $user[0];

        if ($user['password'] !== md5($this->password)) {
            header("Location: ../view/login.php?error=invalidPassword");
            exit();
            

        }

        return true;
    }

    private function isNotEmptyInput() {
        return !empty($this->email) && !empty($this->password);
    }

    private function isEmail() {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        header("location: ../view/login.php");
        exit();
    }
}
?>
