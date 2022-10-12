import CookieProvider from "../../AppProvider/CookieProvider";


class SubsystemHelper{


    constructor() {

    }

    //Получить текущий токен пользователя
    getUserToken(){
        const cookieProvider = new CookieProvider();
        const token = JSON.parse(cookieProvider.readSession("token"));
        return token.type + " " + token.token;
    }

    getUserData(){}

    getUserPermissions(){}

}

export default SubsystemHelper;
