//Провайдер регистрации и аутентификации

import axios from "axios";
import CookieProvider from "./CookieProvider";

class AuthServiceProvider {

    url = "api/user/";

    constructor() {
    }

    async refresh(Authorization, action) {
        await axios.post(this.url + "refresh").then((res) => {
            action({code: 200, authorization: res.headers.authorization});
        }).catch((e) => {
            action({code: e.response.status});
        });
    }

    async login(login, password, action) {
        const body = {"login": login, "password": password};
        await axios.post(this.url + "login", body)
            .then((res) => {
                action({code: 200, data: res.data, headers: res.headers.authorization});
            }).catch((e) => {
                action(e);
            });
    }

    async logout() {
        sessionStorage.clear();
        await axios.post(this.url + "logout");
    }


    async register(login, password, password_confirmation, employeeId, action) {
        const body = {
            "login": login,
            "password": password,
            'password_confirmation': password_confirmation,
            "employee_id": employeeId
        };
        await axios.post(this.url + "register", body).then((res) => {
            action({code: 200, data: res.data});
        }).catch((e) => {
            console.log(e);
            action(e);
        });
    }

    //Для поиска содруника для учетной записи
    async employee(email, action) {
        await axios.get(this.url + "employee/" + email).then((res) => {
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
