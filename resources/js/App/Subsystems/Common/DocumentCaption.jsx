import React, {Component} from 'react';
import BackResource from "./Resources/BackResource";

class DocumentCaption extends Component {
    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="mx-4 my-4 flex">
                <div className="back-button" onClick={this.props.action}>
                    <BackResource/>
                </div>
                <h1 className="text-2xl p-2 my-auto font-light">{this.props.caption}</h1>
            </div>
        );
    }
}

export default DocumentCaption;
