//Провайдер регистрации и аутентификации

import axios from "axios";

class AuthServiceProvider {

    url = "api/user/";


    constructor() {
    }

    getAxios(Authorization) {
        return this.authProvider = axios.create({
            headers: {
                Accept: 'application/json',
                "Content-Type" : "multipart/form-data",
                Authorization: Authorization
            }
        });
    }

    async refresh(Authorization, action) {
        await this.getAxios().post(this.url + "refresh").then((res) => {
            action({code: 200, data: res.data});
        }).catch((e) => {
            action(e);
        });
    }

    async login(login, password, action) {
        const body = {"login": login, "password": password};
        const provider = this.getAxios();
        await provider.post(this.url + "login", body)
            .then((res) => {
                action({code: 200, data: res.data, headers: res.headers.authorization});
            }).catch((e) => {
                action(e);
            });
    }

    async register(login, password, employeeId, action) {
        const body = {"login": login, "password": password, "employee_id": employeeId};
        await this.getAxios().post(this.url + "register", body).then((res) => {
            action({code: 200, data: res.data});
        }).catch((e) => {
            action(e);
        });
    }

    async getEmployee(email, action) {
        await this.getAxios().post(this.url + "email", {"email" : email}).then((res) => {
            action({code: 200, data: res.data});
        }).catch((e) => {
            action(e);
        });
    }

}

export default AuthServiceProvider;
