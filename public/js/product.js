
async function openModalEdit(id) {
    let supper_admin = 'Super admin';
    let response = await api.getProductById({id})
    if(Object.keys(response).length !== 0){
        $("#edit-product").modal('show')
        let data = response.data;
        $("#edit-product #name").val(data.name)
        $("#edit-product #product_id").val(id)
        $("#edit-product #code").val(data.code)
        $("#edit-product #measurement_unit").val(data.measurement_unit)
        $("#edit-product #price").val(data.price)
        $("#edit-product #edit_from_category").val(data.category_id).trigger("change")
        $("#edit-product #edit_from_tax").val(data.tax_id).trigger("change")
        $("#edit-product #blah").attr("src",`${baseUrl}storage/${data.image}`)
        $("#edit-product #blah").attr("width",150)
        $("#edit-product #blah").attr("height",150)
    }
}
function deleteProduct(id) {
    $("#delete-product").modal("show");
    $("#delete-product #product_id").val(id)
}
