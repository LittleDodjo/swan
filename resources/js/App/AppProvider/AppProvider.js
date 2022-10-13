import CookieProvider from "./CookieProvider";
import AuthProvider from "./AuthProvider";
import AppListener from "./AppListener";

class AppProvider {

    state = {
        authProvider: null,
        cookieProvider: null,
        appListener: null,
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
    checkAuth(func) {
        const cookieProvider = this.state.cookieProvider;
        const authProvider = this.state.authProvider;
        if (!cookieProvider.issetSession("token")) {
            func(false);
        } else {
            const token = JSON.parse(cookieProvider.readSession("token"));
            authProvider.refresh(token, func);
        }
    }

    saveAuth(token, user) {
        const cookieProvider = this.state.cookieProvider;
        cookieProvider.writeSession("token", JSON.stringify(token));
        cookieProvider.writeSession("user", JSON.stringify(user));
    }
}

export default AppProvider;
