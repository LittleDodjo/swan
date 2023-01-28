import React, {Component} from 'react';
import ArrowLeft24 from "../Resources/ArrowLeft24";

class SelectInput extends Component {

    constructor(props) {
        super(props);
        this.state = {
            isOpen : false,
        };
    }



    render() {
        return (
            <div className="select-input" onClick={() => {
                let open = !this.state.isOpen;
                this.setState({isOpen: open});
            }}>
                <p>test</p>
                <ArrowLeft24/>
                <div
                    className={`select-input-body"  ${this.state.isOpen ? "" : " hidden"}`}>
                    {this.props.children}
                </div>
            </div>
        );
    }
}

export default SelectInput;
