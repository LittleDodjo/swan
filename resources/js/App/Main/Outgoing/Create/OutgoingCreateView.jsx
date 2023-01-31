import React, {Component} from 'react';
import Header from "../../../Common/Components/Header";
import OutgoingBack from "../Components/OutgoingBack";
import OutgoingCreateBody from "./OutgoingCreateBody";

class OutgoingCreateView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            hasMore: true,
            outgoingDocument: {
                envelopes_count: 1,
                lists_count: 1,
                message_type: 1,
                registration_number: "",
                registration_date: null,
                departure_data: [],
                stamps_used: [],
                executor_id: null,
            }
        };

        this.updateState = this.updateState.bind(this);
        this.save = this.save.bind(this);
    }

    save() {

    }

    updateState(key, value) {
        const content = this.state.outgoingDocument;
        content[key] = value;
        this.setState({outgoingDocument: content});
    }

    render() {
        return (
            <div className="body-view">
                <Header heading={<OutgoingBack caption="Создание исходящего документа"/>}>
                    <p onClick={this.save}>save</p>
                </Header>
                <OutgoingCreateBody action={this.updateState} {...this.state.outgoingDocument}/>
            </div>
        );
    }

}

export default OutgoingCreateView;
