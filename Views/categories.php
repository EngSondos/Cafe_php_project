<?php
include "../layout/head.php";
// include "../Controllers/User/UserController.php";
include "../Models/categories.php";
include "../connection_credits.php";
include "../connection.php";
// include  "../validation.php";
// DeleteCategory(13);

if (isset($_POST) && !empty($_POST)) {
    AddCategory($_POST);
    // var_dump($_POST);
}

if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    DeleteCategory($_GET['delete_id']);
}

if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
    DeleteCategory($_GET['delete_id']);
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
                    <!-- <td><button class="btn btn-warning">Edit</button></td> -->

                    <!-- Button trigger modal -->
                    <td><button class="btn btn-warning" data-toggle="modal" data-target="#modelId">Edit</button></td>
                    <!-- <td><button onclick="DeleteCategory(<?= $row['id'] ?>)" class="btn btn-danger">Delete</button></td> -->
                    <!-- <td><a onclick="DeleteCategory(12)" class="btn btn-danger">Delete</a></td> -->
                    <!-- <td><a href="" onclick="alert(<?= $row['id'] ?>)" class="btn btn-danger">Delete</a></td> -->
                    <td><a href="?delete_id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a></td>
                </tr>


                <!-- Button trigger modal -->

            <?php     }   ?>
        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Submit</button>
                    <button type="reset" class="btn btn-danger  my-3">Reset</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
</script>

<?php
include "../layout/footer.php"
?>