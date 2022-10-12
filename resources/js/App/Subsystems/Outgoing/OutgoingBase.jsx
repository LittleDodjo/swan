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

    openDocument(id) {
        this.setState({openId: id});
    }

    closeDocument() {
        this.setState({openId: null});
    }

    deleteDocument(id) {

    }

    createDocument() {
        this.setState({openId: -1});
    }


    componentDidMount() {

    }

    render() {
        return (
            <>
                {this.state.openId !== null ?
                    <ViewDocument documentId={this.state.openId} action={this.closeDocument}/>
                    : <ViewAllDocument action={this.openDocument}/>
                }

            </>
        );
    }
}

export default OutgoingBase;
