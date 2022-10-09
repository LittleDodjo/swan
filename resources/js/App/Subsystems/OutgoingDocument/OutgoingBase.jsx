import React, {Component} from 'react';
import OutgoingView from "./OutgoingView";

class OutgoingBase extends Component {

    constructor(props) {
        super(props);
        this.state = {
            outgoingView: <OutgoingView/>
        }

        this.selectSubsystem = this.selectSubsystem.bind(this);
    }


    selectSubsystem(page) {
        this.setState({subsystemId: page});
        console.log(page);
    }

    render() {
        return (
            <>
                {this.state.outgoingView}
            </>
        );
    }
}

export default OutgoingBase;