<?php
session_start();

if($_SESSION['login'] !== "Admin"){
    header("location: login.php");
    exit();
}

require '../class/UsersController.php';

$uc = new UsersController();

$email = $_SESSION['email'];
$user = $uc->getUserByEmail($email);

if (!$user) {
    die('User not found');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .profile-details {
            text-align: left;
        }
        .profile-details p {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .btn-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="profile-container text-center">

        <img src="<?= empty($user['photo']) ? 'https://via.placeholder.com/150' : '../img/' . $user['photo'] ?>" alt="Profile Photo" class="profile-image">


        <h2><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></h2>


        <div class="profile-details">
            <p><strong>Bio:</strong> <?= htmlspecialchars($user['bio']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        </div>


        <div class="btn-container">
            <a href="detailuser.php?id=<?= urlencode($user['id']) ?>" class="btn btn-primary">View Details</a>
            <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
