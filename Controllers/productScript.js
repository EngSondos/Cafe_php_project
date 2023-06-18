//*Search on Product
const searchInput = document.getElementById("search-input");
const searchForm = document.getElementById("search-form");
searchInput.addEventListener("input", function () {
  if (searchInput.value === "") {
    // Remove the query string from the URL
    window.history.replaceState({}, document.title, window.location.pathname);
    // searchForm.submit();
    // Set the focus to the input field if it has a value
    searchInput.focus();
    searchForm.submit();
  }
});

//**Click On Add Button */
let addCarts = document.querySelectorAll(".card_bottom .btn_card");
// console.log(addCart);
for (let i = 0; i < addCarts.length; i++) {
  addCarts[i].addEventListener("click", function AddToCart() {
    addCarts[i].innerHTML = '<i class="fa-solid fa-check"></i>';
  });
}

//**Swiper Js*/

const swiper = new Swiper(".swiper", {
  // Optional parameters
  // direction: "vertical",
  loop: true,

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
  },

  // Navigation arrows
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  // And if we need scrollbar
  scrollbar: {
    el: ".swiper-scrollbar",
  },
});
