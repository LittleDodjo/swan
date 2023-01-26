import React, {Component} from 'react';
import HeadingButton from "../../../Common/Components/HeadingButton";
import Settings24 from "../../../Common/Resources/Settings24";
import Door24 from "../../../Common/Resources/Door24";
import Admin24 from "../../../Common/Resources/Admin24";
import AuthServiceProvider from "../../../Providers/AuthServiceProvider";
import Header from "../../../Common/Components/Header";
import EmployeeHeadings from "./EmployeeHeadings";

class EmployeeHeader extends Component {

    constructor(props) {
        super(props);

        this.logout = this.logout.bind(this);
    }

    logout() {
        const authProvider = new AuthServiceProvider();
        authProvider.logout();
    }

    render() {
        return (
            <Header heading={<EmployeeHeadings fullName={this.props.data.fullName} avatar={this.props.data.avatar}
                                               appointment={this.props.data.appointment}/>}>
                {this.props.data.isAdmin && this.props.me ?
                    <HeadingButton svg={<Admin24/>} text="Управление" action={this.props.admin}/> : <></>}
                {this.props.me ?
                    <>
                        <HeadingButton svg={<Settings24/>} text="Настройки" action={this.props.settings}/>
                        <HeadingButton svg={<Door24/>} text="Выход" action={this.logout}/>
                    </> : ""}
            </Header>
        );
    }
}

export default EmployeeHeader;
