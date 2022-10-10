import React, {Component} from 'react';

class CardCaption extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="mx-auto mb-4">
                <h1 className="text-2xl font-light">{this.props.caption}</h1>
            </div>
        );
    }
}

export default CardCaption;
