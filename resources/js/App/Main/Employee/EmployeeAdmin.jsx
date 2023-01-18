import React, {Component} from 'react';
import SplashScreen from "../../Common/Components/SplashScreen";

class EmployeeAdmin extends Component {
    render() {
        return (
            <SplashScreen action={this.props.action} state={this.props.state} caption="Администрирование">
                Администрирование
            </SplashScreen>
        );
    }
}

export default EmployeeAdmin;
