import React, {Component} from 'react';

class EnvelopeTemplate extends React.PureComponent {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="text-end text-3xl text-black m-20">
                <p className="">{this.props.address}</p>
                <p className="">{this.props.name}</p>
            </div>
        );
    }
}

export default EnvelopeTemplate
