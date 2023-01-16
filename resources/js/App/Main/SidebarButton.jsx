import React, {Component} from 'react';
import {Link, NavLink} from "react-router-dom";

class SidebarButton extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <li className="aside-btn">
                <NavLink to={this.props.link} className="aside-btn">
                    {this.props.svg}
                </NavLink>
            </li>
        );
    }
}

export default SidebarButton;
