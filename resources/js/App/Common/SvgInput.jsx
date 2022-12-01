import React, {Component} from 'react';
import User24 from "./Resources/User24";
import BaseInput from "./BaseInput";

class SvgInput extends Component {
    constructor(props) {
        super(props);
        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(e)
    {
        this.props.handleChange(e);
    }

    render() {
        return (
            <div className="relative flex">
                <div className="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    {this.props.svg}
                </div>
                <BaseInput data={this.props.data} handleChange={this.handleChange} name={this.props.name} placeholder={this.props.placeholder} type={this.props.type}/>
            </div>
        );
    }
}

export default SvgInput;
