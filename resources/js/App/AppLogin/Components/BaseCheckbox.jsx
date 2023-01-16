//Классический чекбокс
import React, {Component} from 'react';

class BaseCheckbox extends Component {

    constructor(props) {
        super(props);
        this.state = {
            checked: false,
        };

        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(e)
    {
        this.setState({checked: e.target.checked})
        this.props.handleChange(e);
    }

    componentDidMount() {
        if(this.props.data) {
            this.setState({checked: "checked"});
        }else{
            this.setState({checked: "unchecked"});
        }
    }

    render() {
        return (
            <>
                <input checked={this.state.checked} name={this.props.name} onChange={this.handleChange} id="default-checkbox" type="checkbox" className="checkbox"/>
                <label htmlFor="default-checkbox" className="my-auto ml-2 font-light text-gray-900 dark:text-gray-300">
                    {this.props.value}
                </label>
            </>
        );
    }
}

export default BaseCheckbox;
