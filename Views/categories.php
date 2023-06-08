<?php
include "../layout/head.php";
// include "../Controllers/User/UserController.php";
include "../Models/categories.php";
include "../connection_credits.php";
include "../connection.php";
// include  "../validation.php";


if (isset($_POST) && !empty($_POST)) {
    AddCategory($_POST);
    // var_dump($_POST);
}

?>

<div class="container w-50">
    <h1 class="text-primary mx-auto w-50">Registration Form</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <button type="submit" class="btn btn-primary my-3">Submit</button>
        <button type="reset" class="btn btn-danger  my-3">Reset</button>

    </form>
    <br>
    <table class="table table-striped table-dark border-light  text-center table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>Show</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = DisplayCategory();
            // var_dump($rows);
            foreach ($rows as $row) {
            ?>
                <tr>
                    <?php foreach ($row as $field) {
                        // var_dump($field);
                    ?>
                        <td><?= $field ?></td>
                    <?php     }   ?>
                    <td><a href="" class="btn btn-primary">Show</a></td>
                    <td><a href="" class="btn btn-warning">Edit</a></td>
                    <td><a href="" class="btn btn-danger">Delete</a></td>
                </tr>
            <?php     }   ?>
        </tbody>
    </table>

</div>


<?php
include "../layout/footer.php"
?>