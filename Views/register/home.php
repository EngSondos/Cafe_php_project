<?php
include '../../layout/head.php';
include '../../Controllers/users/users.php';
include "../../MiddleWares/auth.php";

if (!isLoggedIn()) {
    header('Location:login.php');
}

$user = getCurrentUser();
?>
<!-- Style For Products In Home -->
<link rel="stylesheet" href="../../layout/CSS/styleHome.css">

<!-- Start Header -->
<header class="p-50">
    <h1>Begin Your Day ,<br>
        With Your Fav Drink</h1>
    <p>
        " From rich and velvety hot chocolates to refreshing<br> ice-cold lemonades,our drinks are crafted with <br>passion and care to satisfy every taste bud."
    </p>

    <a href="#products"><button style="margin-top: 50px;" type="button" class="btn btn-light">Order Now</button></a>
</header>
<!-- End Header -->

<!-- Start Products -->

<div id="products">
    <div class="container_product">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="card_container">
                        <div class="img_card">
                            <img src="../../assets/products/1 (1).png" alt="">
                        </div>
                        <div class=" card_body">
                            <div class="card_top">
                                <h3>latte</h3>
                            </div>
                            <div class="card_bottom">
                                <h3>50 <span>EGP</span> </h3>
                                <button class="btn_card">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="card_container">
                        <div class="img_card">
                            <img src="../../assets/products/1 (2).png" alt="">
                        </div>
                        <div class=" card_body">
                            <div class="card_top">
                                <h3>limen</h3>
                            </div>
                            <div class="card_bottom">
                                <h3>50 <span>EGP</span></h3>

                                <button class="btn_card">Add</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="card_container">
                        <div class="img_card">
                            <img src="../../assets/products/1 (5).png" alt="">
                        </div>
                        <div class=" card_body">
                            <div class="card_top">
                                <h3>coffee</h3>
                            </div>
                            <div class="card_bottom">
                                <h3>50 <span>EGP</span></h3>
                                <button class="btn_card">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="card_container">
                        <div class="img_card">
                            <img src="../../assets/products/1 (6).png" alt="">
                        </div>
                        <div class=" card_body">
                            <div class="card_top">
                                <h3>juice</h3>
                            </div>
                            <div class="card_bottom">
                                <h3>50 <span>EGP</span></h3>
                                <button class="btn_card">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Products -->



<?php include '../../layout/footer_user.php'; ?>