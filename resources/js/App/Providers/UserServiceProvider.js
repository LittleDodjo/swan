import CookieProvider from "./CookieProvider";

class UserServiceProvider
{

    constructor() {

    }


    //Получить пользователя
    me(){
        const cookieProvider = new CookieProvider();
        const employee = cookieProvider.readSession('employee');
        const user = cookieProvider.readSession('user');
        const roles  = cookieProvider.readSession('roles');
        return {
            user : JSON.parse(user),
            roles: JSON.parse(roles),
            employee: JSON.parse(employee),
        };
    }

    user(id)
    {

    }

}

export default UserServiceProvider;
