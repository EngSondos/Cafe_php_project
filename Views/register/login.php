<?php
include '../../layout/head.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
            <img src="../../assets/design-imgs/barista-illustration-with-wearing-standing-apron-making-coffee-for-customer-in-flat-cartoon-hand-drawn-landing-page-or-web-banner-template-vector.jpg"
            class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <div class="d-flex align-items-center mb-3 pb-1">
            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
            <span class="h1 fw-bold mb-0">Log<span style='color: orange;'>In</span></span>
        </div>
            <form method="POST" enctype="multipart/form-data">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="form1Example13" name="email" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example13">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="form1Example23" name="password" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example23">Password</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-lg btn-block signup-btn">Sign Up</button>
            <div class="d-flex justify-content-around align-items-left mt-4">
                <a href="signup.php">or SignUp?</a>
            </div>
        </form>
        <div class='errors-container'>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include '../../Validation/registerValidation/login.php';
                // include  '../../Controllers/users/users.php';
                loginValidation($_POST['email'], $_POST['password']);
            }
        ?>
        </div>
        </div>
    </div>
</div>
</section>
</body>
</html>

<?php
include '../../layout/footer.php';
?>