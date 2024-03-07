
async function openModalEdit(id) {
    let supper_admin = 'Super admin';
    let response = await api.getStaffById({id})
    if(Object.keys(response).length !== 0){
        $("#edit-staff").modal('show')
        let data = response.data;
        $("#edit-staff #name").val(data.name)
        $("#edit-staff #code").val(data.code)
        $("#edit-staff #address").val(data.address)
        $("#edit-staff #email").val(data.email)
        $("#edit-staff #phone_number").val(data.phone_number)
        $("#edit-staff #birth_date").val(data.birth_date)
        $("#edit-staff #edit_from_center_id").val(data.center_id).trigger("change")
        $("#edit-staff #username").val(data.account.username)
        $("#edit-staff #staff_id").val(id)
        $("#edit-staff #password").attr("required",false)
        $("#edit-staff #supper_admin").prop("checked", data.position === supper_admin)
        $("#edit-staff #blah").attr("src",`${baseUrl}storage/${data.avatar}`)
        $("#edit-staff #blah").attr("width",150)
        $("#edit-staff #blah").attr("height",150)
    }
}
function deleteStaff(id) {
    $("#delete-staff").modal("show");
    $("#delete-staff #staff_id").val(id)
}
