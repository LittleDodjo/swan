import React, {Component} from 'react';
import Header from "../../Common/Components/Header";

class NotificationsView extends Component {
    render() {
        return (
            <>
                <Header heading={<p className="text-2xl font-light">Уведомления</p>}/>
            </>
        );
    }
}

export default NotificationsView;
