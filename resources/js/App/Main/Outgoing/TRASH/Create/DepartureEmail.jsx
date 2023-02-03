import React, {Component} from 'react';

class DepartureEmail extends Component {

    constructor(props) {
        super(props);
        this.state = {

        };

        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(event)
    {
        this.setState({[event.target.name]: event.target.value});
        this.props.action({[event.target.name]: event.target.value});
    }


    render() {
        return (
            <>
                <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Укажите адрес электронной почты</p>
                <input type="email" name="address" onChange={this.handleChange}
                     value={this.state.email}
                     className="basis-4/6 my-auto h-full border-none focus:ring-0"
                     placeholder="Введите электронную почту"/>
            </>
        );
    }
}

export default DepartureEmail;
