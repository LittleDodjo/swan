import React, {Component} from 'react';
import UserHeader from "./Comonents/UserHeader";
import UserServiceProvider from "../../Providers/UserServiceProvider";
import UserBody from "./Comonents/UserBody";
import UserNotFound from "./Comonents/UserNotFound";
import {toast} from "react-hot-toast";

class UserView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            user: null,
            employee: null,
            roles: null,
            id: 12
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
        this.openUser(this.state.id)
    }

    render() {
        if (this.state.user == null) return <></>;
        if (this.state.employee === null || this.state.roles === null) return <UserNotFound id={this.state.id}/>
        const avatar = this.state.employee.first_name[0] + this.state.employee.last_name[0];
        return (
            <div className="flex flex-col">
                <UserHeader me={this.state.id === 0} avatar={avatar} fullName={this.state.employee.full_name}
                            appointment={this.state.employee.appointment} role={this.state.roles}/>
                <UserBody openUser={this.openUser} me={this.state.id === 0} user={this.state.user} employee={this.state.employee}
                          role={this.state.roles}/>
            </div>
        );
    }
}

export default UserView;
