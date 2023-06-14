const Notes = document.getElementsByTagName("textarea")[0],
lineNumbers = document.querySelector(".line-numbers");

let numberOfLines = 0;

if (Notes) {
  numberOfLines = Notes.value.split("\n").length - 1;
  console.log("Dfdsa");
  for (let i = 0; i < numberOfLines; i++) {
    numberLines();
  }

  Notes.addEventListener("keyup", (event) => {
    
    if (event.keyCode === 13) {
      numberOfLines = event.target.value.split("\n").length;
      if (numberOfLines < 150) numberLines();
    }
  });

  Notes.addEventListener("keydown", (event) => {
    console.log(event)
    if (event.key === "Tab") {
      const start = Notes.selectionStart;
      const end = Notes.selectionEnd;

      Notes.value =
        Notes.value.substring(0, start) + "\t" + Notes.value.substring(end);

      event.preventDefault();
    }
  });

}

function numberLines() {
  lineNumbers.innerHTML = Array(numberOfLines).fill("<span></span>").join("");
}

function incrementquantity(availablequantity, product_id, user_id, product_price) {
  span = document.getElementById(product_id);
  span2 = document.getElementById(`prod${product_id}price`);

  counter = span.innerHTML;

  quantity = Number(counter) + 1;
  product_price *= quantity;

  if (counter < availablequantity && product_price < 5000) {
    fetch("../Controllers/cart_controller.php", {
      method: "UPDATE",
      headers: {"Content-Type": "application/json;charset=utf-8"},
      body: JSON.stringify({
        quantity: quantity,
        user_id: user_id,
        product_id: product_id,
        price: product_price,
      }),
    });
    span.innerHTML = quantity;
    span2.innerHTML = product_price;
  }
}

function decrementquantity(product_id, user_id, product_price) {
  span = document.getElementById(product_id);
  span2 = document.getElementById(`prod${product_id}price`);

  counter = span.innerHTML;

  quantity = Number(counter) - 1;

  product_price *= quantity;

  if (counter > 1) {
    fetch("../Controllers/cart_controller.php", {
      method: "UPDATE",
      headers: {"Content-Type": "application/json;charset=utf-8"},
      body: JSON.stringify({
        quantity: quantity,
        user_id: user_id,
        product_id: product_id,
        price: product_price,
      }),
    })
    span.innerHTML = quantity;
    span2.innerHTML = product_price;
  }
}

function removecart(id) {
  popup = document.getElementsByClassName("popupscreen");
  popup[0].style = "display:flex";
  res = "";
  btns = document.getElementsByClassName("popbtn");
  for (const btn of btns) {
    btn.addEventListener("click", () => {
      res = btn.innerHTML;
      if (res == "ok") {
        fetch("../Controllers/cart_controller.php", {
          method: "DELETE",
          headers: {"Content-Type": "application/json;charset=utf-8"},
          body: JSON.stringify({ cartid: id }),
        });
        popup[0].style = "display:none";
        location.reload();
      } else if (res == "cancle") {
        popup[0].style = "display:none";
      }
    });
  }
}

function createorder(userid) {
  fetch("../Controllers/cart_controller.php", {
    method: "POST",
    headers: {"Content-Type": "application/json;charset=utf-8"},
    body: JSON.stringify({ user_id: userid }),
  });
  location.reload();
}

function addToCart(e, product_id, product_price, user_id) {
  e.preventDefault();
  fetch("../../Controllers/cart_controller.php", {
    method: "POST",
    headers: {"Content-Type": "application/json;charset=utf-8"},
    body: JSON.stringify({
      usrid: user_id,
      productid: product_id,
      price: product_price,
    }),
  })
}

function savenotes(id) {
  if (Notes.value.length > 0) {
    fetch("../Controllers/cart_controller.php", {
      method: "UPDATE",
      headers: {
        "Content-Type": "application/json;charset=utf-8",
      },
      body: JSON.stringify({ notes: Notes.value, user_id: id }),
    });
    location.reload();
  }
}






