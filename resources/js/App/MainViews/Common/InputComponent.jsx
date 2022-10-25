import React, {Component} from 'react';

class InputComponent extends Component {

    constructor(props) {
        super(props);

        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(e){
        const inputData = e.target.value;
        const inputName = e.target.name;
        this.props.handle(inputData, inputName);
    }

    render() {
        return (
            <div className="mb-4">
                <input type={this.props.type} placeholder={this.props.placeholder} name={this.props.name} onChange={this.handleChange}
                       className="w-full rounded-full"/>
            </div>
        );
    }
}

export default InputComponent;
