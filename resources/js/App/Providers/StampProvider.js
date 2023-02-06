import axios from "axios";
import CookieProvider from "./CookieProvider";

class StampProvider {

    static baseUrl = 'api/stamps/register/';

    static tax = {
        1: 63,
        2: 66.50,
        3: 70,
        4: 73.50,
        5: 77,
    }

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

    //Берет из провайдера сессии уже заранее подруженные марки из базы
    static stamps() {
        if (CookieProvider.issetSession('stampsRegister')) {
            return CookieProvider.readSession('stampsRegister');
        } else {
            this.index((res) => {
                if (res === 2000) {
                    CookieProvider.writeSession('stampsRegister', res.data);
                    return this.stamps();
                }
            });
        }
    }


    static getPrice(type, weight) {
        if (parseInt(type) === 1) {
            return Math.ceil((parseInt(weight) + 1) / 20) * 3;
        } else {
            let tax = 0;
            const steps = Math.ceil((parseInt(weight) + 1) / 20);
            if (steps > 5) {
                tax = tax + this.tax["5"] + ((Math.ceil((parseInt(weight) + 1) / 20) - 5) * 3);
            } else {
                tax = tax + this.tax[steps];
            }
            return tax;
        }
    }

    // [
    // 0 => [
    //     id => 5,
    // value => 10,
    // count => 50,
    //     ]
    // ]
    static getStamps(price) {
        if(isNaN(price)) return false;
        const stamps = this.stamps().filter(stamp => stamp.count > 0);
        const filterStamps = [];
        const needleStamps = [];
        while (stamps.filter(stamp => !filterStamps.includes(stamp.id)).length !== 0) {
            const stamp = stamps.filter(stamp => !filterStamps.includes(stamp.id))
                .reduce((acc, curr) => parseFloat(acc.value) > parseFloat(curr.value) ? acc : curr);
            const isOne = stamp.count === 1;
            if (parseFloat(price) - parseFloat(stamp.value) < 0) {
                filterStamps.push(stamp.id);
            } else {
                if (needleStamps.find(needle => needle.id === stamp.id) === undefined) {
                    needleStamps.push({
                        id: stamp.id,
                        value: stamp.value,
                        count: 1,
                    });
                    price -= parseFloat(stamp.value);
                    if (isOne) {
                        filterStamps.push(stamp.id);
                    }
                } else {
                    needleStamps.find(needle => needle.id === stamp.id).count += 1;
                    price -= parseFloat(stamp.value);
                    if (isOne) {
                        filterStamps.push(stamp.id);
                    }
                }
            }
        }
        console.log(needleStamps);
        return needleStamps;
    }
}

export default StampProvider;
