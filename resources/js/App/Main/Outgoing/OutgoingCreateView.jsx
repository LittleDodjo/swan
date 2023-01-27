import React, {Component} from 'react';
import Header from "../../Common/Components/Header";
import OutgoingBack from "./Components/OutgoingBack";

class OutgoingCreateView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            marked: false,
        };
    }


    render() {
        return (
            <>
                <Header heading={<OutgoingBack caption="Создание исходящего документа"/>}/>
                <div className="bg-white flex flex-col divide-y divide-indigo-500">

                    <div className="flex relative">
                        <p className="text-lg font-light mx-4 my-auto">Выберете тип письма</p>
                        <div className="cursor-pointer rounded-lg border border-gray-400 p-2 flex fill-gray-400 hover:fill-indigo-500 hover:bg-gray-100">
                            <p>Простое письмо, маркированый конверт</p>
                            <svg className="mx-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"/>
                                <path d="M10.828 12l4.95 4.95-1.414 1.414L8 12l6.364-6.364 1.414 1.414z"/>
                            </svg>
                            <div className="absolute rounded m-4 flex flex-col bg-red-500 top-10 hidden">
                                <div>Вариант первый</div>
                                <div>Вариант второй</div>
                            </div>
                        </div>
                    </div>


                </div>
            </>
        );
    }
}

export default OutgoingCreateView;
