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
                "Content-Type": "multipart/form-data",
                Authorization: Authorization
            }
        });
    }

    async refresh(Authorization, action) {
        await this.getAxios(Authorization).post(this.url + "refresh").then((res) => {
            action({code: 200, authorization: res.headers.authorization});
        }).catch((e) => {
            action({code: e.response.status});
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

    async register(login, password, password_confirmation, employeeId, action) {
        const body = {
            "login": login,
            "password": password,
            'password_confirmation': password_confirmation,
            "employee_id": employeeId
        };
        await this.getAxios().post(this.url + "register", body).then((res) => {
            action({code: 200, data: res.data});
        }).catch((e) => {
            console.log(e);
            action(e);
        });
    }

    async employee(email, action) {
        await this.getAxios().get(this.url + "employee/" + email).then((res) => {
            action({code: 200, employee_id: res.data.employee_id});
        }).catch((e) => {
            action({
                code: e.response.status,
                message: e.response.data.message,
            });
        });
    }

}

export default AuthServiceProvider;
