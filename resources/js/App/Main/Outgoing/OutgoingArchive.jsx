import React, {Component} from 'react';
import SplashScreen from "../../Common/Components/SplashScreen";

class OutgoingArchive extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <SplashScreen action={this.props.action} state={this.props.state}>
                Архивы
            </SplashScreen>
        );
    }
}

export default OutgoingArchive;
