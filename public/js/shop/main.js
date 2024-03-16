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


async function changeCart(node, product_id,seller_id, number) {
    let response = await api.changeCart({product_id, seller_id, number})
    if (Object.keys(response).length !== 0) {
        let number = response.data.number;
        if(number <= 0){
            node.parentNode.classList.remove('d-flex','float-right')
            node.parentNode.classList.add('d-none')
            node.parentNode.parentNode.lastElementChild.classList.remove('d-none')
            node.parentNode.parentNode.lastElementChild.classList.add('float-right')
        }else{
            if(!node.parentNode.classList.contains('d-flex')){
                node.parentNode.classList.remove('float-right')
                node.parentNode.classList.add('d-none')
                node.parentNode.parentNode.firstElementChild.classList.remove('d-none')
                node.parentNode.parentNode.firstElementChild.classList.add('d-flex','float-right')
                node.parentNode.parentNode.firstElementChild.querySelector('input').value = 1
            }else{
                let input = node.parentNode.querySelector('input');
                input.value = number;
            }
        }
        alert("ok")
    }
}
async function enterNumberProduct(node, product_id,seller_id) {
    let number = node.value;
    let response = await api.enterNumberProduct({product_id, seller_id, number})
    if (Object.keys(response).length !== 0) {
        node.value = response.data.number
        if(node.value <= 0){
            node.parentNode.classList.remove('d-flex','float-right')
            node.parentNode.classList.add('d-none')
            node.parentNode.parentNode.lastElementChild.classList.remove('d-none')
            node.parentNode.parentNode.lastElementChild.classList.add('float-right')
        }
        alert("ok")
    }
}
