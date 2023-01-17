import React, {Component} from 'react';
import EmployeeAvatar from "../../../Common/Components/EmployeeAvatar";
import UserHeadings from "./UserHeadings";
import HeadingButton from "./HeadingButton";
import Settings24 from "../../../Common/Resources/Settings24";
import Door24 from "../../../Common/Resources/Door24";
import Admin24 from "../../../Common/Resources/Admin24";
import AuthServiceProvider from "../../../Providers/AuthServiceProvider";

class UserHeader extends Component {

    constructor(props) {
        super(props);
        this.state = {};

        this.logout = this.logout.bind(this);
    }

    logout() {
        const authProvider = new AuthServiceProvider();
        authProvider.logout();
    }

    render() {
        const isAdmin = this.props.role.is_admin || this.props.role.is_root || this.props.role.is_control;
        return (
            <div className="bg-white border-b flex">
                <div className="flex w-full m-4">
                    <EmployeeAvatar text={this.props.avatar}/>
                    <UserHeadings fullName={this.props.fullName} appointment={this.props.appointment.name}/>
                </div>
                <div className="flex">
                    {isAdmin ? <HeadingButton svg={<Admin24/>} text="Управление"/> : <></>}
                    {this.props.me ?
                        <>
                            <HeadingButton svg={<Settings24/>} text="Настройки"/>
                            <HeadingButton svg={<Door24/>} text="Выход" action={this.logout}/>
                        </> : ""
                    }
                </div>
            </div>
        );
    }
}

export default UserHeader;
