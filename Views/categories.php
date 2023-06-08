<?php
include "../layout/head.php";
// include "../Controllers/User/UserController.php";
include "../Models/products/categories.php";
include "../connection_credits.php";
include "../connection.php";
// include  "../validation.php";


if (isset($_POST) && !empty($_POST)) {
    AddCategory($_POST);
    var_dump($_POST);
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
</div>


<?php
include "../layout/footer.php"
?>