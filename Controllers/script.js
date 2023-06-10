function incrementquantity(availablequantity, product_id, user_id, product_price) {
    span = document.getElementById(product_id);
    span2 = document.getElementById(`prod${product_id}price`);

    counter = span.innerHTML;

    quantity = Number(counter) + 1;
    product_price *= quantity;



    if (counter < availablequantity && product_price < 5000) {

        fetch("../Models/product_cartModel.php", {
            "method": "POST",
            "headers": {
                "Content-Type": "application/json;charset=utf-8"
            },
            "body": JSON.stringify({ "quantity": quantity, "user_id": user_id, "product_id": product_id, "price": product_price })
        }).then((res) => {
            return res.json()
        }).then((data) => {
            span.innerHTML = data['quantity'];
            span2.innerHTML = data['price'].toFixed(2) + " EGP";
        })
    }

}

function decrementquantity(product_id, user_id, product_price) {

    span = document.getElementById(product_id);
    span2 = document.getElementById(`prod${product_id}price`);

    counter = span.innerHTML;

    quantity = Number(counter) - 1;

    product_price *= quantity;

    if (counter > 1) {


        fetch("../Models/product_cartModel.php", {
            "method": "POST",
            "headers": {
                "Content-Type": "application/json;charset=utf-8"
            },
            "body": JSON.stringify({ "quantity": quantity, "user_id": user_id, "product_id": product_id, "price": product_price })
        }).then((res) => {
            return res.json()
        }).then((data) => {
            span.innerHTML = data['quantity'];
            span2.innerHTML = data['price'].toFixed(2) + " EGP";
        })
    }

}

function removecart(id) {
    popup = document.getElementsByClassName('popupscreen');
    popup[0].style = "display:flex";
    res = '';
    btns = document.getElementsByClassName('popbtn');
    for (const btn of btns) {
        btn.addEventListener('click', () => {
            res = btn.innerHTML;
            if (res == 'ok') {
                fetch("../Models/product_cartModel.php", {
                    "method": "DELETE",
                    "headers": {
                        "Content-Type": "application/json;charset=utf-8"
                    },
                    "body": JSON.stringify({ "cartid": id })
                })
                popup[0].style = "display:none";
                location.reload();
            } else if (res == 'cancle') {
                popup[0].style = "display:none";
            }
        })
    }


}

// let carts = document.getElementsByClassName('cart-img');
// audio = new Audio('../assets/plateput.mp3')
// // console.log(carts)
// for (const cart of carts) {
//    cart.addEventListener('mouseleave',()=>{
//     audio.play();
//    })
// }
