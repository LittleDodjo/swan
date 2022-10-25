import React, {Component} from 'react';
import SubsystemCaption from "../Common/SubsystemCaption";
import Loader from "../Common/Loader";
import OutgoingProvider from "../SubsystemProvider/OutgoingProvider";
import ViewAllDocument from "./ViewAllDocument";
import ViewDocument from "./ViewDocument";

class OutgoingBase extends Component {

    constructor(props) {
        super(props);
        this.state = {
            provider: new OutgoingProvider(),
            openId: null,
        }

        this.closeDocument = this.closeDocument.bind(this);
        this.openDocument = this.openDocument.bind(this);
        this.deleteDocument = this.deleteDocument(this);
        this.createDocument = this.createDocument.bind(this);
    }

    openDocument(data) {
        const documentId = "open";
        this.setState({openId: documentId, document: data});
    }

    closeDocument() {
        this.setState({openId: null});
    }

    deleteDocument(id) {

    }

    createDocument() {
        this.setState({openId: "create", document: null});
    }


    componentDidMount() {

    }

    render() {
        return (
            <>
                {(this.state.openId !== null && this.state.openId !== 0) ?
                    <ViewDocument closeDocument={this.closeDocument}  document={this.state.document}/>
                    : <ViewAllDocument openDocument={this.openDocument} createDocument={this.createDocument}/>
                }

            </>
        );
    }
}

export default OutgoingBase;
