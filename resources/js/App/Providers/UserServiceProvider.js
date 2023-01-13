import CookieProvider from "./CookieProvider";
import axios from "axios";

class UserServiceProvider {

    url = "api/employee/";


    constructor() {
    }

    getAxios(Authorization) {
        return this.authProvider = axios.create({
            headers: {
                Accept: 'application/json',
                "Content-Type": "multipart/form-data",
                Authorization: Authorization
            }
        });
    }

    //Получить пользователя
    me() {
        const cookieProvider = new CookieProvider();
        const employee = cookieProvider.readSession('employee');
        const user = cookieProvider.readSession('user');
        const roles = cookieProvider.readSession('roles');
        return {
            user: JSON.parse(user),
            roles: JSON.parse(roles),
            employee: JSON.parse(employee),
        };
    }

    async user(id, action) {
        const cookieProvider = new CookieProvider();
        const token = JSON.parse(cookieProvider.readSession("authorization"));
        await this.getAxios(token).get(this.url + id).then((res) => {
            console.log(res)
            action( {
                status: res.status,
                employee: res.data
            });
        }).catch((e) => {
            console.log(e)
        });
        return {employee: null};
    }

    getDepends(depends) {
        const data = [];
        if (depends.employee_depends !== null) {
            data.push({
                type: "Начальник",
                id: depends.employee_depends.id,
                caption: depends.employee_depends.fullName
            });
        }
        if (depends.department_depends !== null) {
            data.push({
                type: "Отдел",
                id: depends.department_depends.id,
                caption: depends.department_depends.caption,
            });
        }
        if (depends.employee_department_depends !== null) {
            data.push({
                type: "Отдел",
                id: depends.employee_department_depends.id,
                caption: depends.employee_department_depends.caption,
            });
        }
        if (depends.management_depends !== null) {
            data.push({
                type: "Управление",
                id: depends.management_depends.id,
                caption: depends.management_depends.caption,
            })
        }
        return data;
    }
}

export default UserServiceProvider;
