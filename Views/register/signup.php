<?php
    ob_start();

    $pageTitle = 'Signup';
    // include '../../layout/head.php';

    include '../../layout/head.php';

    include "../../MiddleWares/guest.php";

?>
<section class="vh-100 bg-brown">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center h-100 mt-4">
        <div class="col-md-8 col-lg-7 col-xl-6 mt-4">
            <img src="../../assets/design-imgs/cover.jpeg"
            class="img-fluid login-img" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <div class="d-flex align-items-center mb-3 pb-1">
            <i class="fas fa-cubes fa-2x me-3" style="color: #d4c085;"></i>
            <span class="h1 fw-bold mb-0" style="color: #d4c085;">Sign<span style='color: white;'>Up</span></span>
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

            <!-- Image input -->
            <div class="form-outline mb-4">
                <input type="file" id="form1Example1322" name="image" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example1322">Upload Image</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Sign Up</button>
            <div class="d-flex justify-content-around align-items-left mt-4">
                <a href="login.php">or Log In?</a>
            </div>
        </form>
        <div class='errors-container'>
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include  '../../Controllers/users/users.php';
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
include '../../layout/footer.php';
ob_end_flush();

?>