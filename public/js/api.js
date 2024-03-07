let baseUrl = 'http://127.0.0.1:8000/'
let api = {
    getStaffById  : async (prop) => {
        const {id} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}admin/web/staff/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {

                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    },
    getCenterById  : async (prop) => {
        const {id} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}admin/web/center/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    rs = response
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }catch(e){

        }
        return rs;
    }


}
