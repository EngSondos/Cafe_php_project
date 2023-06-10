function incrementquantity(availablequantity , product_id, user_id,product_price) {
    span = document.getElementById(product_id);
    span2 = document.getElementById(`prod${ product_id}price`);

    counter=span.innerHTML;

    quantity = Number(counter) + 1;
    product_price *= quantity;

    

    if(counter < availablequantity && product_price < 5000 ){
        
        fetch("../Models/product_cartModel.php", {
            "method": "POST",
            "headers": {
                "Content-Type": "application/json;charset=utf-8"
            },
            "body": JSON.stringify({ "quantity": quantity, "user_id": user_id, "product_id": product_id,"price":product_price })    
        }).then((res)=>{
            return res.json()
        }).then((data)=>{
            span.innerHTML = data['quantity'];
            span2.innerHTML = data['price'].toFixed(2)+" EGP";
        })
    }

}

function decrementquantity(product_id, user_id,product_price) {

    span = document.getElementById(product_id);
    span2 = document.getElementById(`prod${ product_id}price`);

    counter=span.innerHTML;

    quantity = Number(counter) - 1;

    product_price *= quantity;

    if(counter > 1){
        

        fetch("../Models/product_cartModel.php", {
            "method": "POST",
            "headers": {
                "Content-Type": "application/json;charset=utf-8"
            },
            "body": JSON.stringify({ "quantity": quantity, "user_id": user_id, "product_id": product_id ,"price":product_price })    
        }).then((res)=>{
            return res.json()
        }).then((data)=>{
            span.innerHTML = data['quantity'];
            span2.innerHTML = data['price'].toFixed(2)+" EGP";
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

