import React, {Component} from 'react';
import {Link} from "react-router-dom";

class SwapWindow extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="mt-4 cursor-pointer">
                <h1>{this.props.caption} <Link to={this.props.link} className=" underline underline-offset-4 hover:text-indigo-500">{this.props.data}</Link>
                </h1>
            </div>
        );
    }
}

export default SwapWindow;
