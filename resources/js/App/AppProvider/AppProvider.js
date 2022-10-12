import CookieProvider from "./CookieProvider";
import AuthProvider from "./AuthProvider";
import AppListener from "./AppListener";

class AppProvider {

    state = {
        authProvider: null,
        cookieProvider: null,
        appListener: null,
        maxTokenTime: 5,
    }

    constructor() {
        this.state.authProvider = new AuthProvider();
        this.state.cookieProvider = new CookieProvider();
        this.state.appListener = new AppListener();
    }

    getAuthProvider() {
        return this.state.authProvider;
    }

    //проверить авторизацию пользователя
    willAuthorize(func) {
        const cookieProvider = this.state.cookieProvider;
        const authProvider = this.state.authProvider;
        if (!cookieProvider.issetSession("token")) {
            func(false);
        }else {
            if (!cookieProvider.issetSession("tokenTime")) {
                console.log("refreshing...");
                const token = cookieProvider.readSession("token");
                authProvider.refresh(token, func);
            } else {
                console.log("refreshing...1");
                const tokenTime = cookieProvider.readSession("tokenTime");
                const token = JSON.parse(cookieProvider.readSession("token"));
                if (tokenTime > this.state.maxTokenTime) authProvider.refresh(token, func);
                else func(true);
            }
        }
    }

    saveAuth(token, user) {
        const cookieProvider = this.state.cookieProvider;
        cookieProvider.writeSession("token", JSON.stringify(token));
        cookieProvider.writeSession("user", JSON.stringify(user));
        this.resetTokenTime();
    }

    getTokenTime(){
        const cookieProvider = this.state.cookieProvider;
        return parseInt(cookieProvider.readSession("tokenTime"));
    }

    resetTokenTime(){
        const cookieProvider = this.state.cookieProvider;
        cookieProvider.writeSession("tokenTime", JSON.stringify(0));
    }

    updateTokenTime(time){
        const cookieProvider = this.state.cookieProvider;
        cookieProvider.writeSession("tokenTime", JSON.stringify(time));
    }
}

export default AppProvider;
