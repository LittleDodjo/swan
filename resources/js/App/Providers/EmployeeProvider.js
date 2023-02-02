import axios from "axios";

class EmployeeProvider {

    static url = "/api/employee/";


    constructor() {}

    static async index(action)
    {
        await axios.get(this.url).then((res) => {
            console.log(res);
            action({
                status: res.status,
                data: res.data,
            });
        }).catch((e) => {
            console.log("error");
        });
    }

    //получить сотрудника
    static async employee(id, action) {
        await axios.get(this.url + id).then((res) => {
            action({
                status: res.status,
                employee: res.data
            });
        }).catch((e) => {
            action({status : e.response.status});
        });
    }


    //Получить зависимости
    static getDepends(depends) {
        const data = [];
        if (depends.employee_depends !== null) {
            data.push({
                link: "employee",
                type: "Начальник",
                id: depends.employee_depends.id,
                caption: depends.employee_depends.fullName
            });
        }
        if (depends.department_depends !== null) {
            data.push({
                link: "mdep",
                type: "Отдел",
                id: depends.department_depends.id,
                caption: depends.department_depends.caption,
            });
        }
        if (depends.employee_department_depends !== null) {
            data.push({
                link: "edep",
                type: "Отдел",
                id: depends.employee_department_depends.id,
                caption: depends.employee_department_depends.caption,
            });
        }
        if (depends.management_depends !== null) {
            data.push({
                link: "management",
                type: "Управление",
                id: depends.management_depends.id,
                caption: depends.management_depends.caption,
            })
        }
        return data;
    }

    //получить список ролей пользователя
    static getRoles(employee, role){
        const roles = [];
        if (role.is_root) roles.push("Суперпользователь");
        if (role.is_admin) roles.push("Администратор");
        if (role.is_control) roles.push("Контролирующий персонал");
        if (employee.rank >= 3) roles.push("Руководящий персонал");
        if (employee.rank === 2) roles.push("Заместитель начальника отдела");
        if (employee.rank === 1) roles.push("Рядовой сотрудник");
        return roles;
    }
}

export default EmployeeProvider;
