import CookieProvider from "./CookieProvider";
import AuthServiceProvider from "./AuthServiceProvider";


class AppProvider {

    //проверить авторизацию пользователя
    checkAuth(action) {
        const authProvider = new AuthServiceProvider();
        if (!CookieProvider.issetSession("authorization")) {
            action(false);
        } else {
            const token = JSON.parse(CookieProvider.readSession("authorization"));
            authProvider.refresh(token, action);
        }
    }

    //обновить токен авторизации
    saveRefresh(token){
        CookieProvider.writeSession("authorization", JSON.stringify(token));
    }

    //сохранить авторизацию
    saveAuth(token, data) {
        const user = {'login': data.login, 'id': data.id, 'confirmed': data.is_confirmed};
        const role = data.role;
        CookieProvider.writeSession("authorization", JSON.stringify(token));
        CookieProvider.writeSession("employee", JSON.stringify(data.employee));
        CookieProvider.writeSession("user", JSON.stringify(user));
        CookieProvider.writeSession("roles", JSON.stringify(role));
    }

    //сохранить данные входа в систему
    saveRemember(login, password) {
        CookieProvider.writeLocal("login", login);
        CookieProvider.writeLocal("password", password);
        CookieProvider.writeLocal("remember", true);
    }
}

export default AppProvider;
