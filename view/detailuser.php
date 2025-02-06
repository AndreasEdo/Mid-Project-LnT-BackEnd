<?php
include 'header.php';
include '../class/UsersController.php';

$uc = new UsersController();
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

                    <img id="imagePreview" src="<?= empty($user['photo']) ? 'https://via.placeholder.com/500' : '../img/' . $user['photo'] ?>" alt="Profile Image" class="img-fluid rounded-circle mb-3"
                    style="width: 500px; height: 500px; object-fit: cover;">
                </div>

                <div class="w-100">
                    <!-- <p><strong>ID:<?=$user['id']?></strong></p> -->
                    <p><strong>First Name:<?=$user['first_name']?></strong></p>
                    <p><strong>Last Name:<?=$user['last_name']?></strong></p>
                    <p><strong>Email:<?=$user['email']?></strong></p>
                    <p><strong>Password:<?=$user['password']?></strong></p>
                    <!-- <p><strong>Date of Birth:<?=$user['dob']?></strong></p> -->
                    <p><strong>Description:<?=$user['bio']?></strong></p>


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