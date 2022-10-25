import React, {Component} from 'react';
import {ToastContainer, toast} from "react-toastify";

class Notify extends Component {


    constructor(props) {
        super(props);

    }


    render() {
        return (
            <>
                <p className="text-sm font-light">{this.props.text}</p>
            </>
        );
    }
}

export default Notify;
