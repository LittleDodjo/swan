//Классическое текстовое поле
import React, {Component} from 'react';

class BaseInput extends Component {

    constructor(props) {
        super(props);


        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(e) {
        this.props.handleChange(e);
    }

    render() {
        return (
            <>
                <input value={this.props.data} onChange={this.handleChange} name={this.props.name} type={this.props.type} placeholder={this.props.placeholder}
                       className="edit"/>
            </>
        );
    }
}

export default BaseInput;
