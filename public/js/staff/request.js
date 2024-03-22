let overlayElement = document.querySelector('.overlay');
let navCartElement = document.querySelector('.nav-cart');
let url = 'http://127.0.0.1:8000/storage/'

async function openChangeStatus(seller_id) {
    let response = await api.getRequestById({seller_id})
    if (Object.keys(response).length !== 0) {
        let html = "";
        let order = response.data.order;
        order.products.map((product) => {
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
        $("#shipping_address").val(order.shipping_address)
        $("#request_id").val(order.id)
        $("#phone_number").val(order.phone_number)
        $("#status").val(order.status).trigger("change")
        $("#estimated_delivery_date").val(order.estimated_delivery_date)
        overlayElement.style.display = 'block';
        navCartElement.style.display = 'block';
    }
}

async function openInfoOrder(seller_id) {
    let response = await api.getProcessRequestById({seller_id})
    if (Object.keys(response).length !== 0) {
        $("#info_request").modal('show');
        let process = response.data.process
        let html = '<ul>';
        process.map((value, index) => {
            html += `<li>
                <div>
                (${index +1})  ${value.created_at} - ${value.status}
                </div>
                <div>Des : ${value.description}</div>
                <a href="${url}${value.file}" target="_blank">View Image</a>
            </li>`
        })
        html += '</ul>'
        let body = $("#info_request").find('.modal-body');
        body.html(html)
    }
    console.log()
}


overlayElement.onclick =function(){
    overlayElement.style.display = 'none';
    navCartElement.style.display = 'none';
    // navCartElement.style.transform = 'translateX(100%)';
}
