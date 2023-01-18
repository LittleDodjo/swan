import React, {Component} from 'react';

class Close24 extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <svg onClick={() => this.props.action(false)} className={this.props.class} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path fill="none" d="M0 0h24v24H0z"/>
                <path
                    d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/>
            </svg>
        );
    }
}

export default Close24;
