import React, {Component} from 'react';
import SplashScreen from "../../Common/Components/SplashScreen";

class EmployeeSettings extends Component {

    constructor(props) {
        super(props);

    }

    render() {
        return (
            <SplashScreen state={this.props.state} action={this.props.action} caption="Настройки">
                test
            </SplashScreen>
        );
    }
}

export default EmployeeSettings;
