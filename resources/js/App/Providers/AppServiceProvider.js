import CookieProvider from "./CookieProvider";
import AuthServiceProvider from "./AuthServiceProvider";


class AppProvider {

    //проверить авторизацию пользователя
    checkAuth(action) {
        const authProvider = new AuthServiceProvider();
        if (!CookieProvider.issetSession("authorization")) {
            action(false);
        } else {
            const token = CookieProvider.readSession("authorization");
            authProvider.refresh(token, action);
        }
    }

    //обновить токен авторизации
    saveRefresh(token) {
        CookieProvider.writeSession("authorization", token);
    }

    //сохранить авторизацию
    saveAuth(token, data) {
        const user = {'login': data.login, 'id': data.id, 'confirmed': data.is_confirmed};
        const role = data.role;
        CookieProvider.writeSession("authorization", token);
        CookieProvider.writeSession("employee", data.employee);
        CookieProvider.writeSession("user", user);
        CookieProvider.writeSession("roles",role);
    }

    //сохранить данные входа в систему
    saveRemember(login, password) {
        CookieProvider.writeLocal("login", login);
        CookieProvider.writeLocal("password", password);
        CookieProvider.writeLocal("remember", true);
    }

    static isRoot() {
        const employee = CookieProvider.readSession('roles');
        return employee.is_root;
    }

    static isAdmin() {
        const employee = CookieProvider.readSession('roles');
        return employee.is_admin;
    }

    static isControl() {
        const employee = CookieProvider.readSession('roles');
        return employee.is_control;
    }

    static isOutgoing() {
        const employee = CookieProvider.readSession('roles');
        return employee.outgoing_manager;
    }

    static isIngoing() {
        const employee = CookieProvider.readSession('roles');
        return employee.incoming_manager;
    }

    static isConfirmed() {
        const user = CookieProvider.readSession('user');
        return user.confirmed;
    }
}

export default AppProvider;
