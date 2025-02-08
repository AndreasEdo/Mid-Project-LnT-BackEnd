<?php
require '../class/user-account.php';
session_start();

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$lc = new LoginController();


if (isset($_POST['signin'])) {
    $rememberMe = isset($_POST['rememberMe']) ? true : false;
    $lc->login($_POST, $rememberMe);
}


if (isset($_COOKIE['remember_user'])) {
    $userData = json_decode($_COOKIE['remember_user'], true);
    $lc->login($userData, true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style/login.css">
</head>
<body>

<div class="container" id="signIn">
    <h1 class="form-title">Sign In</h1>
    <?php if (isset($errors['login'])): ?>
        <div class="error-main">
            <p><?= htmlspecialchars($errors['login']); ?></p>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input class="input-text" type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="input-group password">
            <i class="fas fa-lock"></i>
            <input class="input-text" type="password" name="password" id="password" placeholder="Password" required>
            <i id="eye" class="fa fa-eye"></i>
        </div>
        <div class="input-group-remember">
            <input type="checkbox" name="rememberMe" id="rememberMe">
            <label class="input-checkbox" for="rememberMe">Remember Me</label>
        </div>
        <input type="submit" class="btn" value="Sign In" name="signin">
    </form>
</div>

<script src="script/login.js"></script>
</body>
</html>
