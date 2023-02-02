import React, {Component} from 'react';

class MarksTableBody extends Component {

    constructor(props) {
        super(props);

    }

    render() {
        return (
            this.props.data.data.map((value, key) => (
                <div className="flex divide-x hover:bg-gray-100 hover:text-indigo-500 text-center" key={key}>
                    <p className="basis-1/6 cursor-pointer p-2">{value.id}</p>
                    <p className="w-full cursor-pointer p-2">
                        {value.document === null ? '(без документа)' : '#' + value.document.id}
                    </p>
                    <p className="w-full cursor-pointer p-2">{value.count} шт.</p>
                    <p className="w-full cursor-pointer p-2">{value.price} руб.</p>
                    <p className="w-full cursor-pointer p-2">{value.date}</p>
                    <p className="w-full cursor-pointer p-2">
                        {value.type ? "Приход" : "Расход"}
                    </p>
                </div>
            ))
        );
    }
}

export default MarksTableBody;
