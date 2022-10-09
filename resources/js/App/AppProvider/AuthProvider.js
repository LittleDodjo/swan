import axios from 'axios';

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

    refresh(token, redirect, save){
        console.log("will ref");
        const provider = axios.create({
            headers:{
                Accept: "application/json",
                Authorization: token.type + " " + token.token,
            }
        });
        const res = provider.post(this.baseUrl + "refresh").then((res) => {
            return save(res.data.authorization, res.data.user);
        }).catch((e) => {
            console.log("redirect");
            redirect();
        });
    }

    // метод авторизации
    authorize(login, password, handleMessage){
        const body = {"login" : login, "password" : password};
        const provider = this.authProvider;
        provider.post(this.baseUrl + "login", body).then((res) => {
            const data = {
                code: res.status,
                message: res.data.status,
                token: res.data.authorization,
                user: res.data.user,
            };
            handleMessage(data);
        }).catch((e) => {
            const data = {
                code: e.response.status,
                message: e.response.data,
            };
            handleMessage(data);
        });
    }

    // метод регистрации
    register(data){

    }
}

export default AuthProvider;
