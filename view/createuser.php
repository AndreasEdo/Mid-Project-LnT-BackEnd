<?php 
include 'header.php';
require '../class/UsersController.php';

session_start();
if($_SESSION['login'] !== "Admin"){
    header("location: login.php");
    exit();
}

$uc = new UsersController();
if(isset($_POST['addBtn'])){
    if(empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['email']) || empty($_POST['password']) || empty($_FILES['photo']['name'])){
        echo "<script>alert('Please fill in all fields.');</script>";
    } else {
        $uc->createUser($_POST, $_FILES['photo']);
        header("Location: dashboard.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="style/addUser.css">
</head>
<body>
<div class="container my-5">
    <div class="card mx-auto" style="width: 150vh;">

        <div class="card-header bg-dark text-white text-center">
            <h3>Add New User</h3>
        </div>

        <div class="card-wrapper">
                
            <div class="image-wrapper">
                <img id="imagePreview" src="" alt="Profile Image" class="img-fluid rounded-circle mb-6" style="width: 325px; height: 250px; object-fit: cover;">
            </div>

            <div class="form-section w-100 all-wrapper">
                <form id="addUserForm" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="imageUpload" class="form-label">Profile Image</label>
                        <input type="file" id="imageUpload" name="photo" class="form-control" accept="image/*">
                    </div>
                    <div class="personal-data-wrapper">
                        <div class="name-wrapper">
                            <div class="input-wrapper">
                                <label class="form-label">First Name</label>
                                <input type="text" name="firstName" class="form-control" placeholder="Enter first name">
                            </div>


                            <div class="input-wrapper">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" name="lastName" class="form-control" placeholder="Enter last name">
                            </div>

                        </div>


                        <div class="login-information-wrapper">
                            <div class="input-wrapper">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email">
                            </div>


                            <div class="input-wrapper">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password">
                            </div>

                        </div>

                    </div>






                    <div class="mb-3">
                        <label for="bio" class="form-label">Description</label>
                        <textarea class="form-control" name="bio" rows="3" placeholder="Enter a brief description"></textarea>
                    </div>


                    <div class="text-center">
                        <button type="submit" name="addBtn" class="btn btn-success w-100">Add User</button>
                        <a type="button" class="btn btn-secondary w-100 mt-3" href="dashboard.php">Close</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
<?php include 'footer.php' ?>
</html>