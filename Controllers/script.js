function incrementquantity(
  availablequantity,
  product_id,
  user_id,
  product_price
) {
  span = document.getElementById(product_id);
  span2 = document.getElementById(`prod${product_id}price`);

  counter = span.innerHTML;

  quantity = Number(counter) + 1;
  product_price *= quantity;

  if (counter < availablequantity && product_price < 5000) {
    fetch("../Models/product_cartModel.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json;charset=utf-8",
      },
      body: JSON.stringify({
        quantity: quantity,
        user_id: user_id,
        product_id: product_id,
        price: product_price,
      }),
    })
      .then((res) => {
        // console.log(res)
        return res.json();
      })
      .then((data) => {
        // console.log(data);
        span.innerHTML = data["quantity"];
        span2.innerHTML = data["price"].toFixed(2) + " EGP";
      });
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
      method: "POST",
      headers: {
        "Content-Type": "application/json;charset=utf-8",
      },
      body: JSON.stringify({
        quantity: quantity,
        user_id: user_id,
        product_id: product_id,
        price: product_price,
      }),
    })
      .then((res) => {
        // console.log(res.json())
        return res.json();
      })
      .then((data) => {
        span.innerHTML = data["quantity"];
        span2.innerHTML = data["price"].toFixed(2) + " EGP";
      });
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
        fetch("../Models/product_cartModel.php", {
          method: "DELETE",
          headers: {
            "Content-Type": "application/json;charset=utf-8",
          },
          body: JSON.stringify({ cartid: id }),
        });
        popup[0].style = "display:none";
        // location.reload();
      } else if (res == "cancle") {
        popup[0].style = "display:none";
      }
    });
  }
}

function createorder(userid) {
  console.log(userid);
  fetch("../Models/ordersModel.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json;charset=utf-8",
    },
    body: JSON.stringify({ user_id: userid }),
  });
}

//check if the textarea has a content or not
const Notes = document.getElementsByTagName("textarea")[0],
  lineNumbers = document.querySelector(".line-numbers");
let numberOfLines = 0;

if (Notes.value.length > 0) {
  //so reload the numberline
  numberOfLines = Notes.value.split("\n").length - 1;
  for (let i = 0; i < numberOfLines; i++) {
    numberLines();
  }
}

function numberLines() {
  lineNumbers.innerHTML = Array(numberOfLines).fill("<span></span>").join("");
  // Notes.style.height = "100vh";
  // Notes.style.resize='vertical';
}

Notes.addEventListener("keyup", (e) => {
  if (e.keyCode == 13) {
    numberOfLines = e.target.value.split("\n").length;
    if (numberOfLines < 150) numberLines();
  }
});
Notes.addEventListener("keydown", (event) => {
  if (event.key === "Tab") {
    const start = Notes.selectionStart;
    const end = Notes.selectionEnd;

    Notes.value =
      Notes.value.substring(0, start) + "\t" + Notes.value.substring(end);

    event.preventDefault();
  }
});

function savenotes(id) {
  if (Notes.value.length > 0) {
    fetch("../Models/ordersModel.php", {
      method: "UPDATE",
      headers: {
        "Content-Type": "application/json;charset=utf-8",
      },
      body: JSON.stringify({ notes: Notes.value, userid: id }),
    });
    // location.reload();
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

function addToCart(e,product_id, product_price, user_id) {
  e.preventDefault();
  fetch("../../Models/product_cartModel.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json;charset=utf-8",
    },
    body: JSON.stringify({
      usrid: user_id,
      productid: product_id,
      price: product_price,
    }),
  })
    .then((res) => {
      console.log(res.json());
      return res.json();
    })
    .then((data) => {
      span.innerHTML = data["quantity"];
      span2.innerHTML = data["price"].toFixed(2) + " EGP";
    });
  //   alert("aaaaaa");
}
