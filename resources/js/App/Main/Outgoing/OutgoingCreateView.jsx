import React, {Component} from 'react';
import Header from "../../Common/Components/Header";
import OutgoingBack from "./Components/OutgoingBack";
import OutgoingCreateBody from "./Components/OutgoingCreateBody";

class OutgoingCreateView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            shape : {
                envelopes_count : 1,
                copies_count: 1,
                lists_count: 1,
                message_type: 1,
                registration_number: "",
                registration_date: null,
                departure_data: [],
                stamps_used: [],
                executor_id: null,
            },
            outgoingDocuments : [

            ],
        };
    }

    componentDidMount() {
        const outgoingDocument = this.state.outgoingDocuments;
        outgoingDocument.push(this.state.shape);
        this.setState({outgoingDocuments : outgoingDocument});
    }

    render() {
        return (
            <>
                <Header heading={<OutgoingBack caption="Создание исходящего документа"/>}/>
                {this.state.outgoingDocuments.map((value, key) => (
                    <OutgoingCreateBody key={key} {...value}/>
                ))}
                <input className="bg-gray-400 hover:text-indigo-500 hover:bg-white rounded shadow-xl w-full border-y" type="button" value="Добавить новый" onClick={() => {
                    let items = this.state.outgoingDocuments;
                    items.push(this.state.shape);
                    this.setState({outgoingDocuments : items});
                    console.log(this.state.outgoingDocuments);
                }}/>
            </>
        );
    }
}

export default OutgoingCreateView;
