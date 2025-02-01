<?php 
include 'header.php';
require '../class/UsersController.php';

$uc = new UsersController();
$users = $uc->showUsers();
$userCount = count($users);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="container my-5 table-responsive-xl">
        <h1 id="user-count">Total Users: <?php echo $userCount; ?></h1>
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
                    <a href="" class="btn btn-warning btn-md">Edit</a>
                    <a href="" class="btn btn-danger btn-md">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>

        </tbody>
        </table>
        <a class="btn btn-primary justify-content-center d-flex" href="#" role="button">Add User</a>
    </div>
    <script>    
        const users = <?php echo json_encode($users); ?>;
    </script>
    <script src="script/search.js"></script>
</body>
</html>
<?php include 'footer.php' ?>