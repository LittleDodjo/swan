import React, {Component} from 'react';
import SelectInput from "../../../Common/Components/SelectInput";
import SelectItem from "../../../Common/Components/SelectItem";

class OutgoingCreateBody extends Component {

    constructor(props) {
        super(props);
        this.state = {
            select: false,
        }

        this.handleChange = this.handleChange.bind(this);
    }


    handleChange(event) {
        this.setState({select: event.target.value});
    }


    render() {
        return (

            <div className="bg-white flex flex-col my-4 border-y divide-y border-gray-400 shadow-lg">
                <div className="flex p-2">
                    <p className="font-light text-xl mx-4 my-auto basis-2/6">Введите количество листов</p>
                    <input type="number" className="h-8 rounded-full text-sm basis-1/4" value={1}/>
                </div>
                <div className="flex p-2">
                    <p className="font-light text-xl mx-4 my-auto basis-2/6">Введите количество конвертов</p>
                    <input type="number" className="h-8 rounded-full text-sm basis-1/4" value={1}/>
                </div>
                <div className="flex p-2">
                    <p className="font-light text-xl mx-4 my-auto basis-2/6">Введите количество копий</p>
                    <input type="number" className="h-8 rounded-full text-sm basis-1/4" value={1}/>
                </div>
                <div className="flex p-2">
                    <p className="font-light text-xl mx-4 my-auto basis-2/6">Введите количество экземпляров</p>
                    <input type="number" className="h-8 rounded-full text-sm basis-1/4" value={1}/>
                </div>
            </div>
        );
    }
}

export default OutgoingCreateBody;


// <select className="h-10 rounded-full my-4 text-sm" value={this.state.select} onChange={this.handleChange}>
//     <option value={0}>Письмо простое, конверт не маркированный</option>
//     <option value={1}>Письмо заказное, конверт маркированный</option>
// </select>
