//Классическая кнопка

import React, {Component} from 'react';

class BaseButton extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        const data = this.props.class;
        return (
            <input onClick={this.props.action} type="button" className={"button " + data} value={this.props.value}/>
        );
    }
}

export default BaseButton;
