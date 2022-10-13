import axios from 'axios';
import AppProvider from "./AppProvider";
import CookieProvider from "./CookieProvider";

class AuthProvider{

    baseUrl = "api/user/";

    // объект axios
    authProvider = null;

    constructor(token = null) {
        const provider = axios.create({
            headers: {
                Accept: "application/json",
                Authorization: token
            }
        });
        this.authProvider = provider;
    }

    async refresh(token, func){
        const provider = axios.create({
            headers:{
                Accept: "application/json",
                Authorization: token.type + " " + token.token,
            }
        });
        await provider.post(this.baseUrl + "refresh").then((res) => {
            const provider  = new AppProvider();
            provider.saveAuth(res.data.authorization, res.data.user);
            func(true);
            return true;
        }).catch((e) => {
            func(false);
        });
    }

    // метод авторизации
    async authorize(login, password, func){
        const body = {"login" : login, "password" : password};
        const provider = this.authProvider;
        await provider.post(this.baseUrl + "login", body).then((res) => {
            const data = {
                code: res.status,
                message: res.data.status,
                token: res.data.authorization,
                user: res.data.user,
            };
            func(data);
        }).catch((e) => {
            const data = {
                e: e,
                // code: e.response.status,
                // message: e.response.data,
            };
            func(data);
        });
    }

    // метод регистрации
    async register(body, func){
        const provider = this.authProvider;
        await provider.post("../" + this.baseUrl+"register", body).then((res) => {
            const data = {
                message: res.data.message,
                status: res.status,
                user: res.data.user,
                token: res.data.authorization
            };
            func(data);
        }).catch((e) => {
            const data = {
                status: e.response.status,
            }
            func(data);
        });
    }
}

export default AuthProvider;
