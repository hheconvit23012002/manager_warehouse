cartElement = document.querySelector('.header_cart');
overlayElement = document.querySelector('.overlay');
navCartElement = document.querySelector('.nav-cart');
// exitElement = document.querySelector('.exit');

async function checkout(seller_id) {
    let response = await api.getInfoCheckOut({seller_id})
    if (Object.keys(response).length !== 0) {
        let html = "";
        let products = response.data.products;
        let seller = response.data.center;
        products.map((product) => {
            html += `
                <tr>
                    <td>${product.code}</td>
                    <td>${product.name}</td>
                    <td>${product.measurement_unit}</td>
                    <td>${product.price}</td>
                    <td>${product.pivot.number}</td>
                </tr>
            `
        })
        $('#data-checkout tbody').html(html)
        $("#shipping_address").val(seller.address)
        $("#phone_number").val(seller.phone_number)
        overlayElement.style.display = 'block';
        navCartElement.style.display = 'block';
    }

}
// exitElement.onclick = function(){
//     overlayElement.style.display = 'none';
//     navCartElement.style.display = 'none';
//     // navCartElement.style.transform = 'translateX(100%)';
// }
overlayElement.onclick =function(){
    overlayElement.style.display = 'none';
    navCartElement.style.display = 'none';
    // navCartElement.style.transform = 'translateX(100%)';
}


async function addToCart(product_id,seller_id) {
    let response = await api.addToCart({product_id, seller_id})
    if (Object.keys(response).length !== 0) {
        alert("ok")
    }
}
