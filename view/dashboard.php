<?php 
include 'header.php';
require '../class/UsersController.php';

$uc = new UsersController();
$users = $uc->showUsers();
$userCount = count($users);

if(isset($_POST['deleteBtn'])){
    $uc->deleteUser($_POST);
    header("Refresh:0");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/popUpWarning.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="container my-5 table-responsive-xl">
        <div class="top-wrapper d-flex justify-content-around">
            <h1 id="user-count">Total Users: <?php echo $userCount; ?></h1>
            <div class="w-20 border border-2 border-primary d-flex justify-content-center align-items-center text-center">
                <a href="#" class="d-block link-dark text-decoration-none ">
                    Search by:
                </a>
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownSearch" data-bs-toggle="dropdown" aria-expanded="false">
                    Name
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item dropdown-search" href="#">Name</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item dropdown-search" href="#">Email</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-flex w-10">
                    <input type="search" id="search-input"  class="form-control" placeholder="Search..." aria-label="Search">
                </form>
            </div>
        </div>

        <table class="table table-dark table-bordered">
        <thead class="thead-dark text-center">
            <tr>
            <th scope="col">No.</th>
            <th scope="col">Foto</th>
            <th scope="col">Full Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="text-center table-group-divider" id="table-wrapper">
            <?php 
            $num = 1;
            foreach($users as $user):
            ?>
            <tr>
                <th scope="row"><?php echo $num++?></th>
                <td class="d-flex justify-content-center">
                    <img src="<?= empty($user['photo']) ? 'https://via.placeholder.com/180x150' : '../img/'. $user['photo']?>" 
                        alt="profile_picture" 
                        style="width: 100px; border-radius: 50%; height:100px;">
                </td>
                <td><?php echo $user['first_name'].' '. $user['last_name']?> </td>
                <td><?php echo $user['email']?> </td>
                <td>
                    <a href="" class="btn btn-primary btn-md">View</a>
                    <a href="editUser.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-md">Edit</a>
                    <button class="btn btn-danger btn-md" onclick="openModal('warningRemove<?= $user['id'] ?>')">Remove</button>
                </td>
            </tr>
            <div class="warning"  id="warningRemove<?= $user['id'] ?>" >
                <div class="warning-wrapper" style="text-align: left">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $user["id"] ?>">
                        <input type="hidden" name="photo" value="<?= $user["photo"] ?>">
                        <img src="assets/warning-icon.png" class="warning-icon">
                        <h5 class="h5-warning">Are you sure you want to delete</h5><h5 class="warning-name"><?php echo $user['first_name'].' '. $user['last_name']?></h5>
                        <div class="button-wrapper">
                            <button type="submit" class="btn btn-danger" name="deleteBtn">Yes</button>
                            <button type="button" class="btn btn-secondary" onclick="closeModal('warningRemove<?= $user['id'] ?>')">No</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </tbody>
        </table>
        <a class="btn btn-primary justify-content-center d-flex" href="#" role="button">Add User</a>
    </div>
    <script>
        const users = <?php echo json_encode($users); ?>;
    </script>
    <script src="script/search.js"></script>
    <script src="script/delete.js"></script>
</body>
</html>
<?php include 'footer.php' ?>
