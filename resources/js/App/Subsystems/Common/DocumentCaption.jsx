import React, {Component} from 'react';

class DocumentCaption extends Component {
    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="mx-4 my-4 flex">
                <h1 className="text-2xl font-light">{this.props.caption} №{this.props.id}</h1>

            </div>
        );
    }
}

export default DocumentCaption;