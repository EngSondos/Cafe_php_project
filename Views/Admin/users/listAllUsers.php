<?php 
    session_start();
    $pageTitle = 'List Users';
    include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/head.php';
    include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/navbar.php';
    include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Models/Admin/getUsers.php';
    include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/config/connectToDB.php';
    $users  = getAllUsers();
?>
<div class="container mt-5">
    <h3 class="display-4">all users</h3>
<a href="addUser.php" class="btn btn-dark ml-auto d-block w-25">Add User</a>
<table class="table text-center mt-4">
  <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Photo</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
<tbody> 
        <?php foreach($users as $user) { ?>
            <tr>
                <th><?php echo $user['id']; ?></th>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo ($user['role'] === 0) ? "Normal User" : "admin"; ?></td>
                <td><img class="tableimg" width='30' src="<?php echo substr($user['image'], 15)?>" alt=""></td>
                <td>
                    <a href="<?php echo 'editUsers.php?do=edit&id=' . $user['id']; ?>"  class="btn btn-primary">Edit</a>
                    <a href="<?php echo 'editUsers.php?do=delete&id=' . $user['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<?php include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/footer.php'; ?>