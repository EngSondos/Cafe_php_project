<?php
include '../Models/product_cartModel.php';
include '../Views/cart_view.php';



//first we need to get all carts from the model
$res = select_carts(1);

// second we need to get all products from the model
$res2 = select_products();

//
$res3 = selectUserCarts(1);


//last step send those data to the view to be rendered
render_carts($res2,$res,$res3);

//
// if (isset($_POST)) {
//     update_quantity();
// }
