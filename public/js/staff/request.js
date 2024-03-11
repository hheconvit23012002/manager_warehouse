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
        $("#estimated_delivery_date").val(order.estimated_delivery_date)
        overlayElement.style.display = 'block';
        navCartElement.style.display = 'block';
    }
}
