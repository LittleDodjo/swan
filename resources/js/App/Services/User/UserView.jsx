import React, {Component} from 'react';
import UserHeader from "./Comonents/UserHeader";
import UserServiceProvider from "../../Providers/UserServiceProvider";
import UserBody from "./Comonents/UserBody";
import UserNotFound from "./Comonents/UserNotFound";

class UserView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            user: null,
            employee: null,
            roles: null,

        }
    }

    componentDidMount() {
        const userProvider = new UserServiceProvider();
        if (this.props.id === 0) this.setState(userProvider.me());
        else {
            this.setState({user: userProvider.me().user});
            this.setState(userProvider.user(this.props.id));
        }
        console.log(userProvider.me());
    }

    render() {
        if (this.state.user == null) return <></>;
        if(this.state.employee === null || this.state.roles === null) return <UserNotFound id={this.props.id}/>
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
