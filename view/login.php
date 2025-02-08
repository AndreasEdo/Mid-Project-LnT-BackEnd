<?php

require '../class/user-account.php';

session_start();
if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
}

$lc = new LoginController();

if(isset($_POST['signin'])){
  $rememberMe = isset($_POST['rememberMe']) ? true : false;
  $lc->login($_POST, $rememberMe);
}

// Check if there's a cookie for remembering the user
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
  <title>Register & Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style/login.css">
</head>

<body>

  <div class="container" id="signIn">
    <h1 class="form-title">Sign In</h1>
    <?php
    if (isset($errors['login'])) {
      echo '<div class="error-main">
                    <p>' . $errors['login'] . '</p>
                    </div>';
      unset($errors['login']);
    }
    ?>
    <form method="POST">
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <?php
        if (isset($errors['email'])) {
          echo ' <div class="error">
                    <p>' . $errors['email'] . '</p>
                </div>';
        }
        ?>
      </div>
      <div class="input-group password">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <i id="eye" class="fa fa-eye"></i>
        <?php
        if (isset($errors['password'])) {
          echo ' <div class="error">
                    <p>' . $errors['password'] . '</p>
                </div>';
        }
        ?>
      </div>
      <div class="input-group">
        <input type="checkbox" name="rememberMe" id="rememberMe">
        <label for="rememberMe">Remember Me</label>
      </div>
      <input type="submit" class="btn" value="Sign In" name="signin">
    </form>
  </div>
  <script src="script/login.js"></script>
</body>

</html>
<?php
if (isset($_SESSION['errors'])) {
  unset($_SESSION['errors']);
}
?>
