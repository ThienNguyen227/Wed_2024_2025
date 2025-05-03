// function loadProducts(page) {
        //     const xhr = new XMLHttpRequest();
        //     xhr.open('GET', '../dao/aj_load_productlist.php?page=' + page, true);
        //     xhr.onload = function() {
        //         if (xhr.status === 200) {
        //             const response = JSON.parse(xhr.responseText);
        //             document.getElementById('product-list').innerHTML = response.list_product;
        //             document.getElementById('pagination').innerHTML = response.pagination;
        //         }
        //     };
        //     xhr.send();
        // }