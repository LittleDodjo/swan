import React, {Component} from 'react';

class CloseRegister extends Component {

    constructor(props) {
        super(props);


    }

    render() {
        return (
            <svg onClick={this.props.action} className="transition-colors delay-75 ease-in-out hover:fill-white absolute top-10 right-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path fill="none" d="M0 0h24v24H0z"/>
                <path
                    d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/>
            </svg>
        );
    }
}

export default CloseRegister;
