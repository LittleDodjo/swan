import React, {Component} from 'react';
import UserHeader from "./Comonents/UserHeader";
import UserServiceProvider from "../../Providers/UserServiceProvider";
import UserBody from "./Comonents/UserBody";
import UserNotFound from "./Comonents/UserNotFound";
import WithRouter from "../../WithRouter";
import {toast} from "react-hot-toast";

class EmployeeView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            user: null,
            employee: null,
            roles: null,
            id: 0
        }
        this.getUser = this.getUser.bind(this);
        this.openUser = this.openUser.bind(this);
    }

    getUser(data) {
        if (data.status === 200) {
            this.setState({
                employee: data.employee,
                id: data.employee.id,
            });
        }else{
            toast.error("Такой сотрудник не найден");
        }
    }

    openUser(employee){
        const userProvider = new UserServiceProvider();
        if (employee === 0) this.setState(userProvider.me());
        else {
            this.setState({
                user: userProvider.me().user,
                roles: userProvider.me().roles,
            });
            userProvider.user(employee, this.getUser);
        }
    }

    componentDidMount() {
        if(this.props.id === null) this.openUser(this.props.params.id);
        else this.openUser(this.props.id);
    }

    render() {
        if (this.state.user == null) return <></>;
        if (this.state.employee === null || this.state.roles === null) return <UserNotFound id={this.state.id}/>
        const avatar = this.state.employee.first_name[0] + this.state.employee.last_name[0];
        return (
            <div className="relative flex h-full flex-col overflow-y-auto overflow-x-hidden">
                <UserHeader me={this.state.id === 0} avatar={avatar} fullName={this.state.employee.full_name}
                            appointment={this.state.employee.appointment} role={this.state.roles}/>
                <UserBody openUser={this.openUser} me={this.state.id === 0} user={this.state.user} employee={this.state.employee}
                          role={this.state.roles}/>
                <div className="absolute h-full w-full pt-20 backdrop-blur-md">
                    <div className="flex h-full flex-col border-t bg-white drop-shadow-2xl">
                        <div className="mx-auto mt-2 h-1 w-60 rounded-full bg-slate-400 drop-shadow-lg"></div>
                        <div className="mt-4 flex flex-col">
                            <div className="w-full border-b p-2 text-2xl font-light flex justify-between">
                                <p className="">Настройки</p>
                                <p className="hover:text-indigo-500 cursor-pointer">Закрыть</p>
                            </div>

                            <div className="flex cursor-pointer divide-x border-b text-center font-light">
                                <div className="w-full p-2 hover:bg-indigo-500 hover:text-white">Приложение</div>
                                <div className="w-full p-2 hover:bg-indigo-500 hover:text-white">Профиль</div>
                            </div>
                            <div className="my-2 divide-y border-y">
                                <div className="flex divide-x">
                                    <div className="w-full p-2">Уведомления</div>
                                    <div className="w-full p-2">Включены</div>
                                </div>
                                <div className="flex divide-x">
                                    <div className="w-full p-2">set1</div>
                                    <div className="w-full p-2">set-2</div>
                                </div>
                                <div className="flex divide-x">
                                    <div className="w-full p-2">set1</div>
                                    <div className="w-full p-2">set-2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default WithRouter(EmployeeView);
