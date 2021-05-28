// prevent pasting any values in pieces input
$("[type='number']").keypress(function (evt) {
    evt.preventDefault();
});
// disable products with only 1 piece
$(".pcs-input").each((i, e) => {
    const max = $(e).attr('max');
    if (max == 1) {
        $(e).prop('disabled', true);
    }
});

// Update live prices on page
$(".pcs-input").bind('keyup mouseup', async function () {
    //update individual product price
    const pcs = $(this).val();
    const name = $(this).siblings("h5").text();
    const productData = await jQuery.ajax({
        url: 'https://eso.vse.cz/~vavl03/sp-vavl03/components/getProduct.php',
        type: 'GET',
        data: {
            productName: name,
            productPcs: pcs,
        },
        dataType: 'json',
        success: function (status, status_message, data) {
            //console.log(status)
        },
        error: function (status, status_message, data) {
            console.log(status);
        }
    });
    const productPrice = productData.data;
    const newPrice = productPrice * pcs;
    $(this).siblings(".product-price").text(newPrice + " $");
    // update total price
    let productPrices = [];
    document.querySelectorAll(".product-price").forEach((list) => {
        productPrices.push(parseInt(list.innerHTML.split(".")[0]));
    });
    const newTotalPrice = productPrices.reduce((a, b) => a + b, 0);
    $('.total-price-number').text(newTotalPrice);

})