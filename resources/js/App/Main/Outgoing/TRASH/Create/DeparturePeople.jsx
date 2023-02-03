import React, {Component} from 'react';

class DeparturePeople extends Component {

    constructor(props) {
        super(props);
        this.state = {
            name: "",
            address: "",
        };

        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(event) {
        this.setState({[event.target.name]: event.target.value});
        this.props.action({[event.target.name]: event.target.value});
    }

    render() {
        return (
            <>
                <div className="flex">
                    <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Введите адрес гражданина</p>
                    <input type="text" name="address" onChange={this.handleChange}
                           value={this.state.address}
                           className="basis-4/6 my-auto h-full border-none focus:ring-0"
                           placeholder="Введите адрес гражданина"/>

                </div>
                <div className="flex">
                    <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Введите имя гражданина</p>
                    <input type="text" name="name" onChange={this.handleChange}
                           value={this.state.name}
                           className="basis-4/6 my-auto h-full border-none focus:ring-0"
                           placeholder="Введите имя гражданина"/>
                </div>
            </>
        );
    }
}

export default DeparturePeople;
