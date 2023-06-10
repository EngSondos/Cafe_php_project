<?php
include '../layout.php';

function render_carts($products, $carts)
{
    echo "<div class='container'>
    <div class='row'>";

    foreach ($carts as $cart) {
        foreach ($products as $product) {
            if ($product['id'] === $cart['product_id']) {
                echo "
                <div class='col-xl-4'>
                    <div class='card'>
                        <div class='cart-img'>
                            <img src='https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxleHBsb3JlLWZlZWR8NXx8fGVufDB8fHx8fA%3D%3D&w=1000&q=80' class='card-img-top' alt='product image'>
                            <div class='cartcontroller'>
                                <button class='btn btn-info w-25' onclick='incrementquantity({$product["quantity"]},{$product["id"]},{$cart['user_id']},{$product['price']})'>plus</button>
                                <span class='card-quantity w-25' id='{$product["id"]}'>";
                                if($product["quantity"] > 0){
                                    echo "{$cart["quantity"]}";
                                }else{
                                    echo "0";
                                };
                                echo"</span>
                                <button class='btn btn-warning w-25' onclick='decrementquantity({$product["id"]},{$cart['user_id']},{$product['price']})'>minus</button>
                            </div>";
                            if($product["quantity"] == 0){
                                echo "<div class='unavailable pro{$product["id"]}'>
                                    <span>Unavailable</span>
                                </div>";
                            }else{
                                echo "<div class='available pro{$product["id"]}'>
                                    <span>Available</span>
                                </div>";
                            };
                           
                        echo "</div>
                        <div class='card-body'>
                            <div class='cart-title justify-content-around align-items-center row flex-row mb-4'>
                                <h5 class='card-title'>{$product["name"]}</h5>
                                <span class='card-price' id='prod{$product["id"]}price'>{$cart["price"]} EGP</span>
                            </div>
                        
                        <button class='btn btn-danger rmv-btn' onclick='removecart()'>Remove From Cart</button>
                        </div>
                    </div>
                </div>";
            }
        }
    }

    echo "</div></div>";
    echo "<script src='script.js'></script>";
   
}
?>