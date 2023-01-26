import React, {Component} from 'react';
import Header from "../../Common/Components/Header";

class OutgoingCreateView extends Component {
    render() {
        return (
            <>
                <Header heading={<p className="text-2xl font-light">Создание исходящего документа</p>}/>
            </>
        );
    }
}

export default OutgoingCreateView;
