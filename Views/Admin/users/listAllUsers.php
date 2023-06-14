<?php 
    ob_start();

    $pageTitle = 'List Users';
    include "../../../layout/head.php";
    include "../../../Models/Admin/getUsers.php";
    include "../../../config/connectToDB.php";
    include "../../../MiddleWares/auth.php";
    include "../../../MiddleWares/admin.php";
    include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Controllers/users/users.php';
    $users  = getAllUsers();

?>
<div class="container mt-5">
<?php 
    if(isset($_GET['delete'])) {
        $id = $_GET['id'];
        $conn = connect();
        $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if($stmt) {
            echo "<span class='alert alert-danger d-block text-center'>User deleted successfully.</span>";
            header("refresh:2;url=listAllUsers.php");
        }else {
            echo "<span class='alert alert-danger d-block text-center'>fiald to delete.</span>";
            header("refresh:2;url=listAllUsers.php");
        }
    }

?>
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
                <td><img class="tableimg" width='30' src="<?php echo substr($user['image'], 17)?>" alt=""></td>
                <td>
                    <a href="<?php echo 'editUsers.php?do=edit&id=' . $user['id']; ?>"  class="btn btn-primary">Edit</a>
                    <a href="<?php echo '?delete&id=' . $user['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<?php 
    include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/footer.php'; 
    ob_end_flush();
?>
