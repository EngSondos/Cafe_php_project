<?php
include '../layout.php';

function render_carts($products, $carts)
{
    echo "<div class='row justify-content-end'>";
    echo "<div class='col-xl-3 p-0 notes'>
                <textarea placeholder='write here the notes you need to add to the order...'></textarea>
                <p>
                1.add\n2.create\n3.delete
                </p>
            </div>";
    echo "<div class='col-xl-9 '>
    <div class='container py-5'>
    <div class='row emptyrow'>";

    if(sizeof($carts)>0){
        
        
        foreach ($carts as $cart) {
            foreach ($products as $product) {
                if ($product['id'] === $cart['product_id']) {
                    echo "
                    <div class='col-xl-4'>
                        <div class='card'>
                            <div class='cart-img'>
                                <img src='../assets/imgs/{$product["image"]}'class='card-img-top' alt='product image'>
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
                            
                            <button class='btn btn-danger rmv-btn' onclick='removecart({$cart["cartid"]})'>Remove From Cart</button>
                            </div>
                        </div>
                    </div>";
                }
            }
        }
        echo "<div class='row align-items-center justify-content-center mb-5 w-100'>
                <button class='btn btn-primary' onclick='createorder(1)'>Order Now</button>
            </div>";
    }
    else{
        echo "<div class='emptycart'>
            <i class='fa-solid fa-cart-plus'></i>
            <p>You may need to add something to cart</p>
        </div>";
    }

    echo "</div></div></div></div>";


    echo "<div class='popupscreen'>
            <div class='popupbox'>
            <p class='warning-mssg'>Are you sure you want to delete this card?</p>
            <div class='warningbtns'>
                <button class='popbtn btn btn-primary'>cancle</button>
                <button class='popbtn btn btn-danger' >ok</button>
            </div>
        </div>

    </div>";

   

    echo "<script src='script.js'></script>";
   
}
?>