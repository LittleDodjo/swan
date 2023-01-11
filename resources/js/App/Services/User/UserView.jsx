import React, {Component} from 'react';
import UserHeader from "./Comonents/UserHeader";
import UserServiceProvider from "../../Providers/UserServiceProvider";
import UserBody from "./Comonents/UserBody";

class UserView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            user: null
        }
    }


    componentDidMount() {
        const userProvider = new UserServiceProvider();
        this.setState(userProvider.me());
        console.log(userProvider.me());
    }

    render() {
        if (this.state.user == null) return <></>;
        const avatar = this.state.employee.first_name[0] + this.state.employee.last_name[0];
        return (
            <div className="flex flex-col">
                <UserHeader avatar={avatar} fullName={this.state.employee.full_name}
                            appointment={this.state.employee.appointment} role={this.state.roles}/>
                <UserBody user={this.state.user} employee={this.state.employee}
                          role={this.state.roles}/>
            </div>
        );
    }
}

export default UserView;
