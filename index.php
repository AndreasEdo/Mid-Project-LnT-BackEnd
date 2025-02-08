<?php
session_start();

function getUserByToken($token) {
    require_once './class/Users.php';
    $userModel = new Users();
    $sql = "SELECT * FROM users WHERE remember_token = ?";
    $stmt = $userModel->connect()->prepare($sql);
    $stmt->execute([$token]);
    return $stmt->fetch();
}

if (isset($_SESSION['login'])) {
    header("Location: view/dashboard.php");
    exit();
}

if (isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];

    $user = getUserByToken($token);
    if ($user) {
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['email'] = $user['email'];

        header("Location: view/dashboard.php");
        exit();
    } else {
        setcookie('remember_token', '', time() - 3600, "/");
    }
}

header("Location: view/login.php");
exit();
?>
