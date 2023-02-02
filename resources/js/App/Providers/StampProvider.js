import axios from "axios";

class StampProvider {

    static baseUrl = 'api/stamps/register/';

    //Получить марки
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

    //получить марку
    static async show(id, action) {
        await axios.get(this.baseUrl + id).then((res) => {
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

    //создать номинал
    static async store(data, action) {
        await axios.post(this.baseUrl, data).then((res) => {
            action({
                status: res.status,
                data: res.data,
            });
        }).catch((e) => action({status: e.response.status, message: e.response.data.message}));
    }

    //создать поступление
    static async balance(data, action) {
        await axios.post("api/stamps/balance", data).then((res) => {
            action({
                status: res.status,
                data: res.data,
            });
        }).catch((e) => action({status: e.response.status}));
    }

    static async delete(id, action) {
    }

    static async forceDelete(id, action) {
    }

    static async archive(action) {
    }

    static async history(action) {
        await axios.get("api/stamps/history").then((res) => {
            action({
                status: res.status,
                data: res.data,
            });
        }).catch((e) => (action({status: e.response.status})));
    }
}

export default StampProvider;
