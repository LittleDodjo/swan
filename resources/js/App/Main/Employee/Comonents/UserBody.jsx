import React, {Component} from 'react';
import UserBodyItem from "./UserBodyItem";
import DependenciesUser from "./DependenciesUser";

class UserBody extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        const roles = [];
        if (this.props.role.is_root) roles.push("Суперпользователь");
        if (this.props.role.is_admin) roles.push("Администратор");
        if (this.props.role.is_control) roles.push("Контролирующий персонал");
        if (this.props.employee.rank >= 3) roles.push("Руководящий персонал");
        if (this.props.employee.rank === 2) roles.push("Заместитель начальника отдела");
        if (this.props.employee.rank === 1) roles.push("Рядовой сотрудник");
        return (
            <>
                {!this.props.me && this.props.employee.user === null ?
                    <div className="border-y mt-2 p-2 bg-white text-center text-slate-500">У данного сотрудника нет
                        учетной записи</div> : ""}

                {this.props.me && !this.props.user.is_confirmed ?
                    <div className="border-y mt-2 p-2 bg-white text-center text-slate-500">Учетная запись не
                        подтверждена, обратитесь к администратору</div> : ""}

                <div className="my-2 border-y bg-white">
                    <div className="border-b p-4 flex">
                        <p className="text-xl font-light">Данные сотрудника</p>
                        <p className="my-auto px-4 hover:underline hover:underline-offset-4 italic font-light text-indigo-500 cursor-pointer">
                            @{this.props.employee.id}
                        </p>
                    </div>
                    <div className="divide-y">
                        <UserBodyItem caption="Организация" data={this.props.employee.organization.name}/>
                        <UserBodyItem caption="Почта" data={this.props.employee.email}/>
                        {this.props.me ? <UserBodyItem caption="Логин" data={this.props.user.login}/> : ""}
                        <UserBodyItem caption="Телефон" data={this.props.employee.phone}/>
                        <UserBodyItem caption="Номер кабинета" data={this.props.employee.cabinet}/>
                        <div className="flex hover:bg-gray-50 p-4">
                            <div className="basis-2/6 my-auto">Роли</div>
                            <div className="my-auto flex">
                                {roles.map((data, key) => (
                                    <p className="mx-2 rounded-full border border-indigo-400 bg-slate-100 p-2 text-sm font-light"
                                       key={key}>{data}</p>
                                ))}
                            </div>
                        </div>
                    </div>

                </div>

                {this.props.employee.rank < 7 ?
                    <DependenciesUser openUser={this.props.openUser} dependency={this.props.employee.dependency}/> : <>/</>}
            </>
        );
    }
}

export default UserBody;
