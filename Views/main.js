let addCarts = document.querySelectorAll(".card_bottom .btn_card");
// console.log(addCart);
for (let i = 0; i < addCarts.length; i++) {
  addCarts[i].addEventListener("click", function AddToCart() {
    addCarts[i].innerHTML = '<i class="fa-solid fa-check"></i>';
  });
}
