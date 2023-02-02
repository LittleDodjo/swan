import React, {Component} from 'react';
import AssignBalance from "./AssignBalance";
import StampCreate from "./StampCreate";

class MarksHeader extends Component {

    constructor(props) {
        super(props);
        this.state = {
            stampsWindow: false,
            stampCreate: false,
        };

        this.stampsWindow = this.stampsWindow.bind(this);
        this.stampCreate = this.stampCreate.bind(this);
    }

    stampsWindow(state) {
        this.setState({stampsWindow: state});
    }

    stampCreate(state){
        this.setState({stampCreate: state});
    }

    render() {
        const last = this.props.last;
        return (
            <>
                <div className="flex h-full flex-col">
                    <div className="mx-10 my-4 flex h-fit flex-col divide-y rounded-xl border bg-white shadow-lg">
                        <div className="flex divide-x">
                            <p className="body-btn rounded-l-xl" onClick={() => this.stampsWindow(true)}>Начислить
                                на балланс</p>
                            <p className="body-btn rounded-r-xl" onClick={() => this.stampCreate(true)}>Добавить номинал</p>
                            <p className="body-btn rounded-r-xl">Создать отчет</p>
                        </div>
                        <div className="flex flex-wrap">
                            <p className="p-2 font-light">Последнее поступление</p>
                            <p className="p-2 text-indigo-500">{last.date}</p>
                            <p className="p-2 font-light">на сумму</p>
                            <p className="p-2 text-indigo-500">{last.price} руб.</p>
                            <p className="p-2 font-light">марок добавлено</p>
                            <p className="p-2 text-indigo-500">{last.total} шт.</p>
                        </div>
                    </div>
                    {this.props.children}
                </div>
                <AssignBalance state={this.state.stampsWindow} action={this.stampsWindow}/>
                <StampCreate state={this.state.stampCreate} action={this.stampCreate}/>
            </>
        );
    }
}

export default MarksHeader;
