<?php 
    // include '../../Controllers/users/users.php';
    session_start();

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Caffee<img width="25" src="../../assets/design-imgs/Food_(1).png" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav m-auto">
      <li class="nav-item mr-4">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item mr-4">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item mr-4">
        <a class="nav-link" href="signup.php">SignUp</a>
      </li>
    </ul>
    <?php
        
        if(isset($_SESSION['user'])){ ?>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">LogOut</a>
                </li>
            </ul>
    <?php }?>
  </div>
</nav>