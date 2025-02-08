<?php
require_once 'Users.php';

class LoginController extends Users {
    private $email;
    private $password;


    private function setUserData($data) {
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
    }

    public function login($data, $rememberMe = false) {
        $this->setUserData($data);

        if (!isset($_SESSION)) {
            session_start();
        }


        $userRole = $this->validateInput();
        if ($userRole) {
            $_SESSION['login'] = $userRole;
            $_SESSION['email'] = $this->email;


            if ($rememberMe) {
                $cookieData = json_encode([
                    'email' => $this->email,
                    'password' => md5($this->password) 
                ]);
                setcookie('remember_user', $cookieData, time() + 7200, "/");
            }


            if ($userRole === "Admin") {
                header("Location: ../view/dashboard.php");
                exit();
            } else {
                header("Location: ../view/userDashboard.php");
                exit();
            }
        } else {
            $_SESSION['errors']['login'] = "Invalid email or password.";
            header("Location: ../view/login.php");
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

        return ($user['id'][0] === 'A') ? "Admin" : "User";
    }


    private function isNotEmptyInput() {
        return !empty($this->email) && !empty($this->password);
    }


    private function isEmail() {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }


    public function logout() {
        session_start();
        session_unset();
        session_destroy();


        if (isset($_COOKIE['remember_user'])) {
            setcookie('remember_user', '', time() - 3600, "/"); 
        }

        header("Location: login.php");
        exit();
    }
}
?>
