import React, {Component} from 'react';
import withRouter from "../withRouter";

class SidebarButton extends Component {

    constructor(props) {
        super(props);

        this.redirect = this.redirect.bind(this);
    }

    redirect() {
        this.props.navigate(this.props.link);
    }

    render() {
        return (
            <li className="aside-btn" onClick={this.redirect}>
                {this.props.svg}
                {!this.props.caption ? "" :
                    <p className="font-light">{this.props.caption}</p>
                }
            </li>
        );
    }
}

export default withRouter(SidebarButton);
