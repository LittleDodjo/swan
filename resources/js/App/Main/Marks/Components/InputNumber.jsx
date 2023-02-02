import React, {Component} from 'react';

class InputNumber extends Component {

    constructor(props) {
        super(props);
        this.state = {
            value: 0
        }

        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(e) {
        this.setState({value: e.target.value});
        this.props.action(this.props.id, e.target.value);
    }

    render() {
        return (
            <input type="number" className="min-h-full w-full px-4 border-none focus:ring-0"
                   placeholder="Укажите номинал"
                   name={this.props.id} min={0} max={500000000}
                   value={this.state.value}
                   onChange={this.handleChange}/>
        );
    }
}

export default InputNumber;
