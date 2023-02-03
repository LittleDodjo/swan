import React, {Component} from 'react';
import Back24 from "../../../../Common/Resources/Back24";
import withRouter from "../../../../withRouter";

class OutgoingBack extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="flex">
                <Back24 action={() => this.props.navigate("/app/outgoing")}/>
                <p className="text-2xl font-light">
                    {this.props.caption}{this.props.id}</p>
            </div>
        );
    }
}

export default withRouter(OutgoingBack);
