import React, {Component} from 'react';
import Back24 from "../../../Common/Resources/Back24";

class OutgoingBack extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="flex">
                <Back24 action={this.props.action}/>
                <p className="text-2xl font-light">
                    Просмотр исходящего документа №{this.props.id}</p>
            </div>
        );
    }
}

export default OutgoingBack;
