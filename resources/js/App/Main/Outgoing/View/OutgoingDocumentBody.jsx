import React, {Component} from 'react';

class OutgoingDocumentBody extends Component {

    constructor(props) {
        super(props);

        this.getSendType = this.getSendType.bind(this);
    }

    getSendType(type) {
        switch (type) {
            case 'mail':
                return 'На электронную почту';
            case 'organization':
                return 'В организацию';
            case 'people':
                return 'Гражданину';
            default:
                return 'неизвестно';
        }
    }

    render() {
        const dateEquals = this.props.data.departure.equals;

        return (
            <div className="flex flex-col">
                <div className="flex flex-col divide-y bg-white shadow-md border border-gray-400 m-4 rounded-xl">
                    <div className="flex cursor-pointer">
                        <h1 className="text-xl  m-4">Письмо {!this.props.data.type ? "заказное, конверт не маркированный" :
                            "простое, конверт маркированный"}</h1>
                        <p className="outgoing-border-date">от {this.props.data.created} г.</p>
                        <h1 className="text-xl  m-4">На основании документа №{this.props.data.registrationNumber}</h1>
                        <p className="outgoing-border-date">от {this.props.data.registrationDate} г.</p>
                    </div>

                    <div className="flex flex-col cursor-pointer">
                        <div className="flex flex-col divide-y">
                            <div className="divide-x flex">
                                <div className="w-full p-4">Количество листов</div>
                                <div className="w-full p-4 text-center">{this.props.data.lists} шт.</div>
                                <div className="w-full p-4">Количество экземпляров</div>
                                <div className="w-full p-4 text-center">{this.props.data.copies} шт.</div>
                                <div className="w-full p-4">Количество конвертов</div>
                                <div className="w-full p-4 text-center">{this.props.data.envelopes} шт.</div>
                            </div>
                        </div>
                    </div>


                </div>

                <div className="flex flex-col divide-y bg-white shadow-md border border-gray-400 m-4 rounded-xl">
                    <div className="flex">
                        <h1 className="text-xl m-4">Документ направлен
                            {this.props.data.departure.total > 1 ? " нескольким адресатам" : " одному адресату"}</h1>
                        {dateEquals ?
                            <p className="outgoing-border-date">{Object.entries(this.props.data.departure)[0][1].date}</p> : ""}
                    </div>
                    <div className="flex flex-col divide-y">
                        {Object.entries(this.props.data.departure).map((value) => (
                            value[0] !== 'total' && value[0] !== 'equals' ?
                                <div className="divide-x flex" key={value[0]}>
                                    <div className="w-full p-4">{this.getSendType(value[0])}
                                        {value[0] === 'people' ? ` (${value[1].name})` : null}</div>
                                    <div className="w-full p-4">
                                        {value[0] === 'organization' ? value[1].address.fullName : value[1].address}
                                    </div>
                                    {!dateEquals ? <div className="w-full p-4">{value[1].date}</div> : null}
                                </div> : null
                        ))}
                    </div>
                </div>

                <div className="flex flex-col divide-y bg-white shadow-md border border-gray-400 m-4 rounded-xl">
                    <div className="flex">
                        <h1 className="text-xl m-4">Использовано марок</h1>
                        <p className="outgoing-border-date">{this.props.data.stamps.total} шт., на
                            сумму {this.props.data.stamps.price} руб.</p>
                    </div>
                    <div className="flex flex-col divide-y">
                        {Object.entries(this.props.data.stamps).map((value) =>
                            value[0] !== 'price' && value[0] !== 'total' ?
                                <div className="divide-x flex" key={value[0]}>
                                    <div className="w-full p-4">Номинал {value[1].value} руб.</div>
                                    <div className="w-full p-4">{value[1].used} шт.</div>
                                </div>
                                : null
                        )}
                    </div>
                </div>


                <div className="flex flex-col divide-y bg-white shadow-md border border-gray-400 m-4 rounded-xl">
                    <div className="flex">
                        <h1 className="text-xl m-4">История документа</h1>
                    </div>
                    <div className="flex flex-col divide-y">
                        <div className="divide-x flex">
                            <div className="w-full p-4">Документ создан</div>
                            <div className="w-full p-4">Дата 24.01.2023</div>
                        </div>
                    </div>
                </div>

            </div>
        );
    }
}

export default OutgoingDocumentBody;
