<link rel="stylesheet" href = "../assets/style.css">

<?php 
    ob_start();
    session_start();

    // include '../../Controllers/users/users.php';
    if(isset($_SESSION['user'])) {
      $user = $_SESSION['user'];
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark custom-bg">
  <a class="navbar-brand" href="#">Caffee<img width="25" src="/Cafe_php_project/assets/design-imgs/Food_(1).png" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav m-auto">
      
    </ul>
    <?php
        if(isset($user) && $user['role'] === 0){ ?>
            <ul class="navbar-nav ms-auto">
              <li class="nav-item mr-4">
                <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                  <a><img src="<?php echo substr($user['image'], 15); ?>" width="30" alt=""></a>
              </li>
              <li class="nav-item">
              <a href="#" class="nav-link"><?= $user['username'] ?></a>
              </li>
            <li class="nav-item">
                    <a><img src="<?=$user['image'] ?>" width="30" alt=""></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Cafe_php_project/Views/register/logout.php">LogOut</a>
                </li>
            </ul>
    <?php }?>
    <?php
        if(isset($user) && $user['role'] === 1) { ?>
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                    <a><img src="<?php echo substr($user['image'], 15); ?>" width="30" alt=""></a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><?= $user['username'] ?></a>
              </li>

              
              <li class="nav-item">
                    <a><img src="<?php echo $user['image'] ?>" width="30" alt=""></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Cafe_php_project/Views/register/logout.php">LogOut</a>
                </li>
            </ul>
    <?php } 
      if(!isset($user)){ ?>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item ">
        <a class="nav-link" href="/Cafe_php_project/Views/register/login.php">Login</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/Cafe_php_project/Views/register/signup.php">SignUp</a>
      </li>
   <?php } ?>
  </ul>
  </div>
</nav>

<?php  ob_end_flush(); ?>