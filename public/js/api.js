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
    },
    getProductById  : async (prop) => {
        const {id} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}admin/web/product/${id}`,
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
    getInfoCheckOut  : async (prop) => {
        const {seller_id} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}home/getInfoCheckOut/${seller_id}`,
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
    getRequestById  : async (prop) => {
        const {seller_id} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}admin/web/request/${seller_id}`,
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
    getProcessRequestById  : async (prop) => {
        const {seller_id} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}admin/web/request/process/${seller_id}`,
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
    changeCart  : async (prop) => {
        const {product_id, seller_id, number} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}home/changeCart`,
                type: 'POST',
                dataType: 'json',
                data : {
                    'product_id' : product_id,
                    'seller_id' : seller_id,
                    'number' : number
                },
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
    enterNumberProduct  : async (prop) => {
        const {product_id, seller_id, number} = prop
        let rs = {}
        try{
            await $.ajax({
                url: `${baseUrl}home/enterNumberProduct`,
                type: 'POST',
                dataType: 'json',
                data : {
                    'product_id' : product_id,
                    'seller_id' : seller_id,
                    'number' : number
                },
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
