import AppProvider from "../../AppProvider/AppProvider";

class UserProvider {

    appProvider = null;

    constructor() {
        this.appProvider = new AppProvider();
    }

    getAppProvider() {
        return this.appProvider;
    }

    getUser() {
        return AppProvider.getUser();
    }

    getToken(){
        return this.appProvider.getToken();
    }
}

export default UserProvider;