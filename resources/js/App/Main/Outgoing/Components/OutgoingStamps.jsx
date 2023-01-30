import React, {Component} from 'react';
import SplashScreen from "../../../Common/Components/SplashScreen";

class OutgoingStamps extends Component {
    render() {
        return (
            <SplashScreen state={this.props.state} action={this.props.action} caption="Настройки">
                test
            </SplashScreen>
        );
    }
}

export default OutgoingStamps;
