// Thư viện AOS
AOS.init();

function showUpdateModal(key) {
  const modalId = "updateModal_" + key;
  const modalElement = document.getElementById(modalId);
  const modal = new bootstrap.Modal(modalElement);
  modal.show();

  const quantityInput = modalElement.querySelector(".quantity-input");
  if (quantityInput && !quantityInput.dataset.listenerAttached) {
    quantityInput.addEventListener("input", () => updateTotalPrice(key));
    quantityInput.dataset.listenerAttached = "true";
  }
}

function updateTotalPrice(key) {
  const modalElement = document.getElementById("updateModal_" + key);
  const quantityInput = modalElement.querySelector(".quantity-input");
  const unitPriceElement = modalElement.querySelector(".unit-price");
  const totalPriceElement = modalElement.querySelector(".total-price");

  let unitPrice = unitPriceElement.innerText.replace(/\D/g, ""); // bỏ dấu chấm, ₫,...
  let quantity = parseInt(quantityInput.value);

  if (isNaN(quantity) || quantity < 1) {
    quantity = 1;
    quantityInput.value = quantity;
  }

  let total = unitPrice * quantity;
  totalPriceElement.innerText =
    new Intl.NumberFormat("vi-VN").format(total) + "₫";
}

function increaseQuantity(key) {
  const quantityInput = document.querySelector(
    `#updateModal_${key} .quantity-input`
  );
  quantityInput.value = parseInt(quantityInput.value) + 1;
  updateTotalPrice(key);
}

function decreaseQuantity(key) {
  const quantityInput = document.querySelector(
    `#updateModal_${key} .quantity-input`
  );
  let newQuantity = parseInt(quantityInput.value) - 1;
  if (newQuantity < 1) newQuantity = 1;
  quantityInput.value = newQuantity;
  updateTotalPrice(key);
}

function updateDetailTotalPrice() {
  const unitPriceEl = document.querySelector(".unit-price");
  const quantityInput = document.querySelector(".quantity-input");
  const totalPriceEl = document.querySelector(".total-price");

  let unitPrice = parseInt(unitPriceEl.innerText.replace(/\D/g, ""));
  let quantity = parseInt(quantityInput.value);

  if (isNaN(quantity) || quantity < 1) {
    quantity = 1;
    quantityInput.value = quantity;
  }

  let total = unitPrice * quantity;
  totalPriceEl.innerText = new Intl.NumberFormat("vi-VN").format(total);
}

function increaseDetailQuantity() {
  const quantityInput = document.querySelector(".quantity-input");
  quantityInput.value = parseInt(quantityInput.value) + 1;
  updateDetailTotalPrice();
}

function decreaseDetailQuantity() {
  const quantityInput = document.querySelector(".quantity-input");
  let newQuantity = parseInt(quantityInput.value) - 1;
  if (newQuantity < 1) newQuantity = 1;
  quantityInput.value = newQuantity;
  updateDetailTotalPrice();
}

// Gọi tự động khi người dùng nhập tay số lượng
document.addEventListener("DOMContentLoaded", function () {
  const quantityInput = document.querySelector(".quantity-input");
  quantityInput.addEventListener("input", updateDetailTotalPrice);
});

// function showForm(type) {
//   if (type === "self") {
//     document.getElementById("form-self").style.display = "block";
//     document.getElementById("form-other").style.display = "none";
//   } else {
//     document.getElementById("form-self").style.display = "none";
//     document.getElementById("form-other").style.display = "block";
//   }
// }

// Mặc định hiện form đặt cho bản thân
// window.onload = function () {
//   showForm("self");
// };

// Nút xóa đơn hàng

// const confirmDeleteModal = document.getElementById("confirmDeleteModal");
// confirmDeleteModal.addEventListener("show.bs.modal", function (event) {
//   const button = event.relatedTarget;
//   const key = button.getAttribute("data-key");
//   const input = confirmDeleteModal.querySelector("#deleteKeyInput");
//   input.value = key;
// });

document.addEventListener("DOMContentLoaded", function () {
  const confirmDeleteModal = document.getElementById("confirmDeleteModal");

  if (confirmDeleteModal) {
    confirmDeleteModal.addEventListener("show.bs.modal", function (event) {
      const button = event.relatedTarget;
      const key = button.getAttribute("data-key");
      const input = confirmDeleteModal.querySelector("#deleteKeyInput");
      input.value = key;
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  let buttons = document.querySelectorAll(".btn-favorite");

  if (buttons.length > 0) {
    buttons.forEach((btn) => {
      btn.addEventListener("click", function () {
        const productId = this.dataset.productId;
        fetch("dao/ajax_favorite.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: "product_id=" + productId,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.status === "added") {
              this.querySelector("i").classList.remove("text-muted");
              this.querySelector("i").classList.add("text-danger");
            } else if (data.status === "removed") {
              this.querySelector("i").classList.remove("text-danger");
              this.querySelector("i").classList.add("text-muted");
            }
          });
      });
    });
  } else {
    console.log("Lỗi");
  }
});
