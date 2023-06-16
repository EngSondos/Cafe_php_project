<link rel="stylesheet" href = "../../layout/CSS/homestyle.css">


<?php
    include '../../layout/head.php';
    include '../../Controllers/users/users.php';
    include "../../MiddleWares/auth.php";





    
    if (!isLoggedIn()) {
        header('Location:login.php');
    }

    $user = getCurrentUser();
?>

<header> 
<h1>Begin Your Day ,<br>
     With Your Fav Drink</h1>
<p>
"From rich and velvety hot chocolates 
to refreshing<br> ice-cold lemonades,our drinks are crafted with  <br>passion and care to satisfy every taste bud."
</p>

<a href="#products" ><button  style="margin-top: 50px;" type="button" class="btn btn-light">Order Now</button></a>
</header>


<section id="products">

products
</section>









</section>


<?php include '../../layout/footer.php'; ?>