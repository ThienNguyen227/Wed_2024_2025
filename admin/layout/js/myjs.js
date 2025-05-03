// Thanh tìm kiếm và lọc ở product_list.php
// document
//   .getElementById("searchButtonProduct")
//   .addEventListener("click", function () {
//     var keyword = document.getElementById("searchInputProduct").value;
//     var filter = document.getElementById("filterSelectProduct").value;

//     var xhr = new XMLHttpRequest();

//     xhr.open(
//       "GET",
//       "../dao/aj_ad_search_filter_product.php?keyword=" +
//         encodeURIComponent(keyword) +
//         "&filter=" +
//         encodeURIComponent(filter),
//       true
//     );

//     xhr.onreadystatechange = function () {
//       if (xhr.readyState == 4 && xhr.status == 200) {
//         document.querySelector("tbody").innerHTML = xhr.responseText;
//       }
//     };

//     xhr.send();
//   });
// Thanh tìm kiếm và lọc ở management_user.php
document
  .getElementById("searchButtonUser")
  .addEventListener("click", function () {
    var keyword = document.getElementById("searchInputUser").value;
    var filter = document.getElementById("filterSelectUser").value;

    var xhr = new XMLHttpRequest();

    xhr.open(
      "GET",
      "../dao/aj_ad_search_filter_user.php?keyword=" +
        encodeURIComponent(keyword) +
        "&filter=" +
        encodeURIComponent(filter),
      true
    );

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        document.querySelector("tbody").innerHTML = xhr.responseText;
      }
    };

    xhr.send();
  });
