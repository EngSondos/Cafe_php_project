<?php
include '../layout.php';

function render_carts($products, $carts, $totalcarts)
{
    /*first divide our page to two columns the sidebar and the carts */
    echo "
    <div class='row h-100 mr-0'>".
    //first column
        "<div class='col-xl-4 h-100 pr-0'><div class='sidebar'>".
    //show number of carts
            "<h4 class='mycarts bg-light d-flex justify-content-center'>My Carts<span class='cartsnum'>" . sizeof($carts) . "</span></h4>".
    //inject textarea to store notes in
            "<div class='row justify-content-center m-0' style='height: 40vh;width: 100%;align-items: center; '>
                <div id='row1'>
                    <div class='line-numbers'>
                        <span></span>
                    </div>
                     <textarea placeholder='write here the notes you need...'></textarea>
                    </div>
                    <button class='btn btn-danger savebtn' onclick='savenotes(1)'><i class='fa-solid fa-chevron-right'></i></button>
                    <div id='row2'>
                        <pre id=''>".trim($totalcarts[0]["notes"])."</pre>
                    </div>
                </div>".
                "<span class='totalprice'>Total Price: ".$totalcarts[0]["total_price"].' EGP'."</span>".
                "<div class='row align-items-center justify-content-center mb-5 w-100'>
                    <button class='btn btn-primary' onclick='createorder(1)'>Order Now</button>
                </div>".
            "</div>
        </div>".
        "<div class='col-xl-8'>".
        //container
            "<div class='container'>".
                "<div class='row'>";
                    //three columns of carts
                    if (sizeof($carts) > 0) {
                        foreach ($carts as $cart) {
                            foreach ($products as $product) {
                                if ($product['id'] === $cart['product_id']) {
                                    echo "
                                    <div class='col-xl-4'>
                                        <div class='card'>
                                            <div class='card-img'>
                                                <img src='../assets/imgs/{$product["image"]}'class='card-img-top' alt='product image'>
                                                <div class='cardcontroller'>
                                                    <button class='btn btn-info w-25' onclick='incrementquantity({$product["quantity"]},{$product["id"]},{$cart['user_id']},{$product['price']})'>plus</button>
                                                    <span class='card-quantity w-25' id='{$product["id"]}'>";
                                    if ($product["quantity"] > 0) {
                                        echo "{$cart["quantity"]}";
                                    } else {
                                        echo "0";
                                    };
                                    echo "</span>
                                            <button class='btn btn-warning w-25' onclick='decrementquantity({$product["id"]},{$cart['user_id']},{$product['price']})'>minus</button>
                                        </div>";
                                    if ($product["quantity"] == 0) {
                                        echo "<div class='unavailable pro{$product["id"]}'>
                                                <span>Unavailable</span>
                                            </div>";
                                    } else {
                                        echo "<div class='available pro{$product["id"]}'>
                                                <span>Available</span>
                                            </div>";
                                    };
                
                                    echo "</div>
                                            <div class='card-body p-0 pb-3'>
                                                <div class='card-header justify-content-around align-items-center row flex-row mb-4'>
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
                        
                    } else {
                        echo "<div class='emptycart'>
                            <i class='fa-solid fa-cart-plus'></i>
                            <p>You may need to add something to cart</p>
                        </div>";
                    }
            echo"</div>".
            "</div>".
        "</div>".
    "</div>".

    //the script that contains functions
    "<script src='script.js'></script>";

}   
