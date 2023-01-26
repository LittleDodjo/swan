import React, {Component} from 'react';
import SplashScreen from "../../Common/Components/SplashScreen";

class OutgoingFilter extends Component {
    render() {
        return (
            <SplashScreen action={this.props.action} state={this.props.state}>
                Фильтр
            </SplashScreen>
        );
    }
}

export default OutgoingFilter;
