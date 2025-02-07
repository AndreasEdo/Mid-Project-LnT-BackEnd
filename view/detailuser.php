<?php
include 'header.php';
include '../class/UsersController.php';

$uc = new UsersController();

if (!isset($_GET['id'])) {
    die('User  ID not provided');
}

$user = $uc->getOneUser($_GET['id']);

if (!$user) {
    die('User  not found');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail User</title>
</head>
<body>
    <div class="container my-5">
        <div class="card mx-auto" style="width: 150vh;">
            <div class="card-header bg-dark text-white text-center">
                <h3>View User</h3>
            </div>

            <div class="card-body bg-dark text-white d-flex align-items-center">

                <div class="image-preview-container me-5">

                    <img id="imagePreview" src="<?= empty($user['photo']) ? 'https://via.placeholder.com/325x250' : '../img/' . $user['photo'] ?>" alt="Profile Image" class="img-fluid rounded-circle mb-3"
                    style="width: 325px; height: 250px; object-fit: cover;">
                </div>

                <div class="w-100">                    
                    <p><strong>ID: <?= htmlspecialchars($user['id'] ?? 'N/A') ?></strong></p>
                    <p><strong>First Name: <?= htmlspecialchars($user['first_name'] ?? 'N/A') ?></strong></p>
                    <p><strong>Last Name: <?= htmlspecialchars($user['last_name'] ?? 'N/A') ?></strong></p>
                    <p><strong>Email: <?= htmlspecialchars($user['email'] ?? 'N/A') ?></strong></p>
                    <p><strong>Password: <?= htmlspecialchars($user['password'] ?? 'N/A') ?></strong></p>
                    <p><strong>Description: <?= htmlspecialchars($user['bio'] ?? 'N/A') ?></strong></p>


                    <div class="text-center">
                        <a type="button" class="btn btn-secondary w-100 mt-3" href="dashboard.php">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php include 'footer.php' ?>