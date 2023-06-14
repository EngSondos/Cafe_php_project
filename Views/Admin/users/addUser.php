<?php
    ob_start();
    session_start();
    $pageTitle = 'Add User';
    include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/head.php';
    include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/navbar.php';

?>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center h-100">
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <div class="d-flex align-items-center mb-3 pb-1">
            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
            <span class="h1 fw-bold mb-0">Add New User</span></span>
        </div>
            <form method="POST" enctype="multipart/form-data">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="form1Example13" name="email" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example13">Email address</label>
            </div>
            <!-- UserName input -->
            <div class="form-outline mb-4">
                <input type="text" id="form1Example1311" name="username" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example1311">UserName</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="form1Example23" name="password" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example23">Password</label>
            </div>
            <div class="form-outline mb-4">
                <select name="role" id="form1Example233" class="form-control form-control-lg">
                    <option value="">Select Role</option>
                    <option value="0">Normal User</option>
                    <option value="1">Admin</option>
                </select>
                <!-- <input type="select" id="form1Example233" name="role" class="form-control form-control-lg" /> -->
                <label class="form-label" for="form1Example233">Role</label>
            </div>
            <!-- Image input -->
            <div class="form-outline mb-4">
                <input type="file" id="form1Example1322" name="image" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example1322">Upload Image</label>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-lg btn-block signup-btn mb-5">Add</button>
        </form>
        <div class='errors-container'>
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include  $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/Controllers/users/users.php";
                userController($_POST, $_FILES);
            }
        ?>
        </div>
        </div>
        </div>
    </div>
</div>
</section>

<?php
    include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/footer.php';
    ob_end_flush();
?>