import React, {Component} from 'react';
import ArrowLeft24 from "../Resources/ArrowLeft24";

class SelectInput extends Component {

    constructor(props) {
        super(props);
        this.state = {

        };
    }



    render() {
        return (
            <div className="select-input" onClick={this.props.action()}>
                <div
                    className={"select-input-body"}>
                    {this.state.text}
                </div>
            </div>
        );
    }
}

export default SelectInput;
