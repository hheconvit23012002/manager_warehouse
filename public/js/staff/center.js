
async function openModalEdit(id) {
    // $("#edit-center #name").val(data.name)
    let response = await api.getCenterById({id})
    if(Object.keys(response).length !== 0){
        let data = response.data;
        $("#edit-center").modal('show')
        $("#edit-center #name").val(data.name)
        $("#edit-center #center_id").val(id)
        $("#edit-center #code").val(data.code)
        $("#edit-center #address").val(data.address)
        $("#edit-center #address2").val(data.address2)
        $("#edit-center #email").val(data.email)
        $("#edit-center #phone_number").val(data.phone_number)
        $("#edit-center #bank_account_mame").val(data.bank_account_mame)
        $("#edit-center #bank_account_number").val(data.bank_account_number)
        $("#edit-center #tax_code").val(data.tax_code)
        $("#edit-center #edit_from_center_type").val(data.type).trigger("change")
        $("#edit-center #blah").attr("src",`${baseUrl}storage/${data.logo}`)
        $("#edit-center #blah").attr("width",150)
        $("#edit-center #blah").attr("height",150)
    }
}
function deleteCenter(id) {
    $("#delete-center").modal("show");
    $("#delete-center #center_id").val(id)
}
