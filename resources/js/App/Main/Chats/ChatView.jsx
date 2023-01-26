import React, {Component} from 'react';
import Header from "../../Common/Components/Header";

class ChatView extends Component {
    render() {
        return (
            <>
                <Header heading={<p className="text-2xl font-light">Чаты</p>}/>
            </>
        );
    }
}

export default ChatView;
