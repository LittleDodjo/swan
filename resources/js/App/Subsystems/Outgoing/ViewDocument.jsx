import React, {Component} from 'react';
import DocumentCaption from "../Common/DocumentCaption";

class ViewDocument extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <>
                <DocumentCaption caption="Исходящий документ" id={this.props.documentId}/>
            </>
        );
    }
}

export default ViewDocument;
