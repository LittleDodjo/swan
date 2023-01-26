import React, {Component} from 'react';
import Header from "../../Common/Components/Header";

class IngoingView extends Component {
    render() {
        return (
            <>
                <Header heading={<p className="text-2xl font-light">Реестр входящих документов</p>}/>
            </>
        );
    }
}

export default IngoingView;
