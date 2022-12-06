import CookieProvider from "./CookieProvider";
import AuthServiceProvider from "./AuthServiceProvider";


class AppProvider {

    //проверить авторизацию пользователя
    checkAuth(action) {
        const cookieProvider = new CookieProvider();
        const authProvider = new AuthServiceProvider();
        if (!cookieProvider.issetSession("authorization")) {
            action(false);
        } else {
            const token = JSON.parse(cookieProvider.readSession("authorization"));
            authProvider.refresh(token, action);
        }
    }

    saveRefresh(token){
        const cookieProvider = new CookieProvider();
        cookieProvider.writeSession("authorization", JSON.stringify(token));
    }

    saveAuth(token, data) {
        const cookieProvider = new CookieProvider();
        const user = {'login': data.login, 'id': data.id, 'confirmed': data.is_confirmed};
        const role = data.role;
        cookieProvider.writeSession("authorization", JSON.stringify(token));
        cookieProvider.writeSession("employee", JSON.stringify(data.employee));
        cookieProvider.writeSession("user", JSON.stringify(user));
        cookieProvider.writeSession("roles", JSON.stringify(role));
    }

    saveRemember(login, password) {
        const cookieProvider = new CookieProvider();
        cookieProvider.writeLocal("login", login);
        cookieProvider.writeLocal("password", password);
        cookieProvider.writeLocal("remember", true);
    }
}

export default AppProvider;
