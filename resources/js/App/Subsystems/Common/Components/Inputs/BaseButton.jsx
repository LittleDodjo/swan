import React, {Component} from 'react';

class BaseButton extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="classic-button" onClick={this.props.action}>
                {this.props.resource}
                <input type="button" value={this.props.value} className="mx-auto"/>
            </div>
        );
    }
}

export default BaseButton;
