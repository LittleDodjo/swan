import React, {Component} from 'react';
import withRouter from "../../withRouter";

class ButtonRounded extends Component {
    render() {
        return (
            <div className={`${this.props.class}`} onClick={this.props.action}>
                {this.props.svg}
                <p>{this.props.caption}</p>
            </div>
        );
    }
}

ButtonRounded.defaultProps = {
    class: 'rounded-button',
}

export default withRouter(ButtonRounded);
