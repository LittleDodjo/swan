import axios from "axios";
import {act} from "react-dom/test-utils";

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

    static async store()
    {}

    static async delete(id)
    {}

    static async forceDelete(id)
    {}

    static async archive()
    {}

    static async restore()
    {}

}

export default OutgoingProvider;