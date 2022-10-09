import CookieProvider from "./CookieProvider";
import AuthProvider from "./AuthProvider";

class AppProvider{

    state = {
        authProvider: null,
        cookieProvider: null,
    }

    constructor() {
        this.state.authProvider = new AuthProvider();
        this.state.cookieProvider = new CookieProvider();
    }

    saveAuth(token, user){
        const CookieProvider = this.state.cookieProvider;
        CookieProvider.writeSession("token", JSON.stringify(token));
        CookieProvider.writeSession("user", JSON.stringify(user));
    }

    updateTokenTime(time){
        const CookieProvider = this.state.cookieProvider;
        CookieProvider.writeSession("lastTimeToken", JSON.stringify(time));
    }

    getTokenTime(){
        const CookieProvider = this.state.cookieProvider;
        const time = CookieProvider.readSession("lastTimeToken");
        if(time === "null") return false;
        else return parseInt(time);
    }

    getToken() {
        const token = sessionStorage.getItem('token');
        return JSON.parse(token);
    }

    getUser() {
        const user = sessionStorage.getItem('user');
        return JSON.parse(user);
    }

    willAuthorized(redirect, willSave){
        if(sessionStorage.getItem('token') !== null) {
            const provider = this.getAuthProvider();
            const data = provider.refresh(this.getToken(), redirect, willSave);
        }else{
            redirect();
        }
    }

    getCookieProvider(){
        return this.state.cookieProvider;
    }

    getAuthProvider(){
        return this.state.authProvider;
    }
}

export default AppProvider;
