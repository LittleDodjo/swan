import React, {Component} from 'react';

class BaseLink extends Component {

    constructor(props) {
        super(props);

        this.handleClick = this.handleClick.bind(this);
    }

    handleClick() {
        this.props.action();
    }

    render() {
        return (
            <div className="mx-auto my-4 flex">
                <p className="link" onClick={this.handleClick}>{this.props.value}</p>
            </div>
        );
    }
}

export default BaseLink;
