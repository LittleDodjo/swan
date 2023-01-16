import React, {Component} from 'react';

class NotificationsView extends Component {
    render() {
        return (
            <>
                <div className="border-b bg-white flex p-4 font-light">
                    <p className="text-3xl">
                        Уведомления
                    </p>
                </div>
                <div className="my-2 border-y bg-white p-4">
                    <p className="text-slate-400 font-light italic underline text-center">Увдеомлений пока нет</p>
                </div>
            </>
        );
    }
}

export default NotificationsView;
