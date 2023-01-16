//Провайдер регистрации и аутентификации

import axios from "axios";
import CookieProvider from "./CookieProvider";

class AuthServiceProvider {

    url = "api/user/";

    constructor() {
    }

    getAxios(Authorization = "") {
        return {
            headers: {
                Accept: 'application/json',
                "Content-Type": "multipart/form-data",
                Authorization: Authorization
            }
        }
    }

    async refresh(Authorization, action) {
        await axios.post(this.url + "refresh", {}, this.getAxios(Authorization)).then((res) => {
            action({code: 200, authorization: res.headers.authorization});
        }).catch((e) => {
            action({code: e.response.status});
        });
    }

    async login(login, password, action) {
        const body = {"login": login, "password": password};
        await axios.post(this.url + "login", body, this.getAxios())
            .then((res) => {
                action({code: 200, data: res.data, headers: res.headers.authorization});
            }).catch((e) => {
                action(e);
            });
    }

    async logout(Authorization){
        await axios.post(this.url + "logout", {}, this.getAxios(Authorization)).then(() => {
            const cookieProvider = new CookieProvider();
            cookieProvider.removeSession("user");
            cookieProvider.removeSession("employee");
            cookieProvider.removeSession("roles");
            cookieProvider.removeSession("authorization");
        }).catch(() => {
            const cookieProvider = new CookieProvider();
            cookieProvider.removeSession("user");
            cookieProvider.removeSession("employee");
            cookieProvider.removeSession("roles");
            cookieProvider.removeSession("authorization");
        });
    }

    async register(login, password, password_confirmation, employeeId, action) {
        const body = {
            "login": login,
            "password": password,
            'password_confirmation': password_confirmation,
            "employee_id": employeeId
        };
        await axios.post(this.url + "register", body, this.getAxios()).then((res) => {
            action({code: 200, data: res.data});
        }).catch((e) => {
            console.log(e);
            action(e);
        });
    }

    //Для поиска содруника для учетной записи
    async employee(email, action) {
        await axios.get(this.url + "employee/" + email, {}, this.getAxios()).then((res) => {
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
