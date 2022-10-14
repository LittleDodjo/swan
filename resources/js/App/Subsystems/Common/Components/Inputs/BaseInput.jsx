import React, {Component} from 'react';
import SearchResource from "../../Resources/SearchResource";

class BaseInput extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <>
                <input type="text" placeholder={this.props.placeholder}
                       className="classic-text text-xs rounded-full h-10 my-auto pl-10"/>
            </>
        );
    }
}

export default BaseInput;
