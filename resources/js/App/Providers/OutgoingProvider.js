import axios from "axios";

class OutgoingProvider {

    static url = "/api/outgoing";


    static async index(page, action)
    {
        await axios.get(this.url + "?page="+page).then((res) => {
            action({
                status: res.status,
                data: res.data,
                page: res.page,
                total: res.total,
            });
        }).catch((e) => {
            action({
                status: e.response.status,
            });
        });
    }

    static async show(id, action)
    {
        await axios.get(this.url+"/"+id).then((res) => {
            action({
                status: res.status,
                data: res.data,
            });
        }).catch((e) => {
            action({
                status: e.response.status,
            });
        })
    }

    static async store(body, action)
    {
        await axios.post(this.url, body).then((res) => {
            action({
                status: res.status,
                data: res.data,
            });
        }).catch((e) => {
            console.log(e);
            action({
                status: e.response.status,
                message: e.response.message,
            });
        });
    }

    static async delete(id, action)
    {
        console.log(this.url+"/"+id);
        await axios.delete(this.url+"/"+id).then((res) => {
            action({
                status: res.status,
                data: res.data,
            });
        }).catch((e) => {
            action({
                status: e.response.status,
            });
        })
    }

    static async update(id, body, action){
        await axios.patch(this.url+'/'+id, body).then((res) => {
            action({
                status: res.status,
                data: res.data,
            });
        }).catch((e) => {
            action({
                status: e.response.status,
            });
        })
    }


    static GetDepartureType(type){
        switch (type){
            case 'organization':
                return 'Организация';
            case 'people':
                return 'Гражданин';
            case 'mail':
                return 'E-Mail';
            default:
                return '(null)';
        }
    }

}

export default OutgoingProvider;
