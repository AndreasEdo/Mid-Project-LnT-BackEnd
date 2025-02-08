<?php 
session_start();
if($_SESSION['login'] !== "User"){
    header("location: login.php");
    exit();
}

require '../class/user-account.php';

$lc = new LoginController();
if (isset($_POST['logoutBtn'])) {
    $lc->logout();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Hello User</h1>
    <form method="POST"><button class="dropdown-item" name="logoutBtn" href="#">Sign out</button></form>
</body>
</html>