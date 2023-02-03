import React, {Component} from 'react';

class OutgoingInput extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="flex">
                <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">{() => this.props.caption(e)}</p>
                <input type={this.props.type}
                       className="basis-4/6 my-auto h-full border-none focus:ring-0 uppercase"
                       placeholder="Введите номер" onChange={this.props.handleChange}/>
            </div>
        );
    }
}

export default OutgoingInput;
