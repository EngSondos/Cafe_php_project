function incrementquantity(product_id, user_id) {

    span = document.getElementById(product_id);

    counter=span.innerHTML;

    quantity = Number(counter) + 1;

    if(counter < 100){
        fetch("../Models/product_cartModel.php", {
            "method": "POST",
            "headers": {
                "Content-Type": "application/json;charset=utf-8"
            },
            "body": JSON.stringify({ "quantity": quantity, "user_id": user_id, "product_id": product_id })    
        }).then((res)=>{
            return res.json()
        }).then((data)=>{
            span.innerHTML = data;
        })
    }

}

function decrementquantity(product_id, user_id) {

    span = document.getElementById(product_id);

    counter=span.innerHTML;
    if(counter > 1){
        quantity = Number(counter) - 1;

        fetch("../Models/product_cartModel.php", {
            "method": "POST",
            "headers": {
                "Content-Type": "application/json;charset=utf-8"
            },
            "body": JSON.stringify({ "quantity": quantity, "user_id": user_id, "product_id": product_id })    
        }).then((res)=>{
            return res.json()
        }).then((data)=>{
            span.innerHTML = data;
        })
    }

}
//////////////////
function removecart(){

    if(counter > 1){
        quantity = Number(counter) - 1;

        fetch("../Models/product_cartModel.php", {
            "method": "POST",
            "headers": {
                "Content-Type": "application/json;charset=utf-8"
            },
            "body": JSON.stringify({ "quantity": quantity, "user_id": user_id, "product_id": product_id })    
        }).then((res)=>{
            return res.json()
        }).then((data)=>{
            span.innerHTML = data;
        })
    }
}
////////////////////

