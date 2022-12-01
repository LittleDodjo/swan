//Классическая кнопка

import React, {Component} from 'react';

class BaseButton extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <input onClick={this.props.action} type="button" className="button border border-slate-400" value={this.props.value}/>
        );
    }
}

export default BaseButton;
