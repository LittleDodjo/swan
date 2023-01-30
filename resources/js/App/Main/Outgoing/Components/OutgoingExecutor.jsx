import React, {Component} from 'react';
import SplashScreen from "../../../Common/Components/SplashScreen";
import SplashLoader from "../../../AppLogin/Components/SplashLoader";

class OutgoingExecutor extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loaded: false,
        };

    }


    componentDidMount() {

    }


    render() {
        return (
            <SplashScreen action={this.props.action} state={this.props.state} caption="Выбрать исполнителя">
                {this.state.loaded ?
                    "test"
                    : <SplashLoader/>}
            </SplashScreen>
        );
    }
}

export default OutgoingExecutor;
