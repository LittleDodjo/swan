import React, {Component} from 'react';
import update from 'immutability-helper';
import Header from "../../../Common/Components/Header";
import OutgoingBack from "../Components/OutgoingBack";
import OutgoingCreateBody from "./OutgoingCreateBody";
import InfiniteScroll from "react-infinite-scroll-component";

class OutgoingCreateView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            hasMore: true,
            outgoingDocuments: [],
        };

        this.updateState = this.updateState.bind(this);
        this.pushDocument = this.pushDocument.bind(this);
        this.save = this.save.bind(this);
    }

    save() {

    }

    pushDocument() {
        if (this.state.outgoingDocuments.length >= 10) {
            this.setState({hasMore: false});
            return;
        }
        const outgoingDocument = this.state.outgoingDocuments;
        outgoingDocument.push({
            envelopes_count: 1,
            lists_count: 1,
            message_type: 1,
            registration_number: "",
            registration_date: null,
            departure_data: [],
            stamps_used: [],
            executor_id: null,
        });
        this.setState({outgoingDocuments: outgoingDocument,});
    }

    updateState(id, key, value) {
        const data = this.state.outgoingDocuments;
        const newData = update(data, {[id] : {$merge: {[key] : value}}});
        this.setState({outgoingDocuments: newData});
    }

    componentDidMount() {
        this.pushDocument();
        this.pushDocument();
    }

    render() {
        return (
            <div className="relative">
                <Header heading={<OutgoingBack caption="Создание исходящего документа"/>}>
                    <p onClick={this.save}>save</p>
                </Header>
                <InfiniteScroll dataLength={this.state.outgoingDocuments.length} hasMore={this.state.hasMore}
                                scrollableTarget="scrollableDiv" className="flex flex-col"
                                loader={<h4>Loading...</h4>} next={this.pushDocument}>
                    {this.state.outgoingDocuments.map((value, key) => (
                        <OutgoingCreateBody action={this.updateState} key={key} id={key} {...value}/>
                    ))}
                </InfiniteScroll>
            </div>
        );
    }

}

export default OutgoingCreateView;
