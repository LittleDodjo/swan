import axios from "axios";

class OrganizationProvider {

    static baseUrl = "api/register/correspondent/";

    static async index(action) {
        await axios.get(this.baseUrl).then((res) => {
            action({
                status: res.status,
                data: res.data,
            });
        }).catch((e) => {
            action({
                status: e.response.status,
            });
        });
    }

    static async show(id, action) {
        await axios.get(this.baseUrl+id).then((res) => {
            action({
                status: res.status,
                data: res.data,
            });
        }).catch((e) => {
            action({status : e.response.status});
        });
    }

    static async store(data, action) {

    }

    static async delete(id, action) {

    }

    static async forceDelete(){

    }

    static async archive(){

    }

}

export default OrganizationProvider;
