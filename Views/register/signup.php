<?php
    ob_start();

    $pageTitle = 'Signup';
    include '../../layout/head.php';
    include '../../layout/navbar.php';


?>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
            <img src="../../assets/design-imgs/cover-section.jpg"
            class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <div class="d-flex align-items-center mb-3 pb-1">
            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
            <span class="h1 fw-bold mb-0">Sign<span style='color: orange;'>Up</span></span>
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
            <button type="submit" class="btn btn-primary btn-lg btn-block signup-btn">Sign Up</button>
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