<?php 
include 'header.php';
require '../class/UsersController.php';

session_start();
if($_SESSION['login'] !== "Admin"){
    header("location: login.php");
    exit();
}

$uc = new UsersController();
$user = $uc->getOneUser($_GET['id']);


if(isset($_POST['updateBtn'])){
    $uc->updateUser($user, $_POST, $_FILES['photo']);
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style/editUser.css">
</head>
<body>
    <div class="container my-5">
        <div class="card mx-auto" style="width: 150vh;">
            <div class="card-header bg-warning text-white text-center">
                <h3>Edit User</h3>
            </div>

            <div class="card-wrapper">
                
                <div class="image-wrapper">
                    <img id="imagePreview" src="<?= empty($user['photo']) ? 'https://via.placeholder.com/180x150' : '../img/'. $user['photo']?>" class="photo">
                </div>

                <div class="form-section w-100 all-wrapper">
                    <form id="editUserForm" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="imageUpload" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="imageUpload" name="photo" accept="image/*">
                        </div>
                        <div class="personal-data-wrapper">
                            <div class="name-wrapper">
                                <div class="input-wrapper">
                                    <label class="form-label">First Name</label>
                                    <input type="text" required class="form-control" name="firstName" placeholder="Enter first name" value="<?= $user['first_name'] ?>" >
                                </div>


                                <div class="input-wrapper">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" required class="form-control" id="last_name" name="lastName" placeholder="Enter last name" value="<?= $user['last_name'] ?>">
                                </div>

                            </div>


                            <div class="login-information-wrapper">
                                <div class="input-wrapper">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" required class="form-control" id="email" name="email" placeholder="Enter email" value="<?= $user['email'] ?>">
                                </div>


                                <div class="input-wrapper">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password (leave blank to keep current)">
                                </div>

                            </div>

                        </div>






                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea required class="form-control" id="bio" name="bio" rows="3" placeholder="Tell about yourself"><?= $user['bio'] ?></textarea>
                        </div>


                        <div class="text-center">
                            <button type="submit" name="updateBtn" class="btn btn-danger w-100">Update User</button>
                            <a type="button" class="btn btn-secondary w-100 mt-3" href="dashboard.php">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="script/imageUpload.js"></script>
    <script src="script/emailValidation.js"></script>
</body>
</html>


<?php include 'footer.php'?>