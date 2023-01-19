import React, {Component} from 'react';
import withRouter from "../../withRouter";

class RedirectLink extends Component {

    constructor(props) {
        super(props);

        this.redirect = this.redirect.bind(this);
    }

    redirect() {
        this.props.navigate(this.props.link);
    }


    render() {
        return (
            <div className="my-auto">
                <p className="redirect-link" onClick={this.redirect}>{this.props.caption}</p>
            </div>
        );
    }
}

export default withRouter(RedirectLink);
