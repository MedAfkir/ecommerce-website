$(function () {
  $(document).click((e) => {
    if (!document.querySelector(".categories-dropdown").contains(e.target)) {
      $(".categories-values").removeClass("active");
    }
  });

  $(document).keydown((e) => {
    // hide categories dropdown
    if (
      $(".categories-values").hasClass("active") &&
      (e.key === "Escape" || e.key === "Tab")
    ) {
      $(".categories-values").removeClass("active");
    }
  });
  // show categories dropdown
  $(".select-category").click((e) =>
    $(".categories-values").toggleClass("active")
  );
  $(".categories-values li").click((e) => {
    const value = e.target.textContent.toLowerCase();
    $(".select-category").html(value);
    $("#search-form input[name='category']").val(value);
    $(".categories-values").removeClass("active");
  });

  $("#login-form input")
    .focus((e) => {
      const label = $(e.target.previousElementSibling);
      label.addClass("active");
      $(e.target).addClass("active");
    })
    .blur((e) => {
      const label = $(e.target.previousElementSibling);
      if (!$(e.target).val()) {
        label.removeClass("active");
        $(e.target).removeClass("active");
      }
    });
  $(".decrement").click((e) => {
    const input = $(e.target).next();
    const productID = +input.parent().parent().attr("data-product-id");
    $.ajax({
      url: `${location.pathname}/${productID}/${+input.val() - 1}`,
      method: "GET",
      dataType: "json",
      success: function (result) {
        if (typeof result != "boolean") {
          updateProductQuantity(result, input);
          updatePriceTotal();
        }
      },
    });
    const subTotal = input.parent().next().next();
  });
  $(".increment").click((e) => {
    const input = $(e.target).prev();
    const productID = +input.parent().parent().attr("data-product-id");

    $.ajax({
      url: `${location.pathname}/${productID}/${+input.val() + 1}`,
      method: "GET",
      dataType: "json",
      success: function (result) {
        if (typeof result != "boolean") {
          updateProductQuantity(result, input);
          updatePriceTotal();
        }
      },
    });
  });
});

function updateProductQuantity(newQuantity, input) {
  const productEl = input.parent().parent();
  productEl.attr("data-product-quantity", newQuantity);

  const pricePerUnit = +productEl.attr("data-product-price");
  const subTotal = input.parent().next().next();
  input.val(newQuantity);
  subTotal.html(`$${(pricePerUnit * newQuantity).toFixed(2)}`);
}

if (location.pathname === "/project/cart") {
  updatePriceTotal();

  const modalBtnClose = $(".modal .modal-footer button.close");
  modalBtnClose.click(function (e) {
    $(".modal").removeClass("show");
  });

  const btn = $(".price-total button.checkout");
  btn.click(function () {
    $.ajax({
      url: `${location.pathname}/request`,
      method: "GET",
      dataType: "json",
      success: function ({ success, message }) {
        const modalTitle = $(".modal .modal-title");
        const modalBody = $(".modal .modal-body");

        $(".modal").addClass("show");
        modalTitle.html(success ? "Succées" : "Erreur");
        modalBody.html(message);
      },
    });
  });
}

function updatePriceTotal() {
  const priceTotalEl = $(".price-total");

  const products = $(".products-body");
  const priceTotal = [...products.children()]
    .map(
      (el) =>
        +$(el).attr("data-product-quantity") * +$(el).attr("data-product-price")
    )
    .reduce((prevValue, curr) => prevValue + curr, 0);

  priceTotalEl
    .children(".subtotal")
    .children(".number")
    .html(`$${priceTotal.toFixed(2)}`);
  priceTotalEl
    .children(".total")
    .children(".number")
    .html(`$${priceTotal.toFixed(2)}`);
}

const forms = document.querySelectorAll("form");

[...forms].forEach((form) => {
  form.addEventListener("submit", (e) => {
    let error = false;
    [...e.target]
      .filter((input) => input.type !== "submit" && input.type !== "button")
      .forEach((input) => {
        if (!input.value.length) error = true;
      });

    if (error) e.preventDefault();
  });
});
