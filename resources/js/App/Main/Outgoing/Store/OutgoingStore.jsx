import React, {Component} from 'react';
import ButtonRounded from "../../../Common/Components/ButtonRounded";
import Plus24 from "../../../Common/Resources/Plus24";

class OutgoingStore extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="flex flex-col">
                <div className="flex justify-between">
                    <h1 className="text-3xl m-4">Создание исходящего документа</h1>
                    <ButtonRounded caption="Создать документ" svg={<Plus24/>}/>
                </div>
                <div className="back-card">
                    <div className="flex border-b pb-4 mb-4">
                        <p className="text-lg my-auto basis-2/6">Укажите тип письма</p>
                        <div className="flex w-full">
                            <select name="message_type" className="mr-2 rounded-lg basis-1/4">
                                <option value={1}>Простое</option>
                                <option value={0}>Заказное</option>
                            </select>
                            <input type="number" placeholder="Введите вес письма в граммах"
                                   className="rounded-lg w-full"/>
                        </div>
                    </div>
                    <div className="flex pb-4">
                        <p className="text-lg my-auto basis-2/6">Укажите номер регистрации</p>
                        <input type="text" className="rounded-lg w-full" placeholder="Номер регистрации"/>
                    </div>
                    <div className="flex pb-4 mb-4 border-b">
                        <p className="text-lg my-auto basis-2/6">Укажите дату регистрации</p>
                        <input type="date" className="rounded-lg w-full"/>
                    </div>
                    <div className="flex pb-4 border-b mb-4">
                        <p className="text-lg my-auto basis-2/6">Выберете исполнителя</p>
                        <p className="w-full p-2 rounded-lg border text-center bg-gray-100 hover:bg-gray-200 hover:text-indigo-500">
                            Выбрать</p>
                    </div>
                    <div className="flex pb-4 mb-4">
                        <p className="text-lg my-auto basis-2/6">Выберете тип отправления</p>
                        <select name="departure_type" className="w-full rounded-lg">
                            <option value="organization">В организацию</option>
                            <option value="email">На электронную почту</option>
                            <option value="people">Гражданину</option>
                        </select>
                    </div>
                    <div className="flex pb-4 border-b mb-4">
                        <p className="text-lg my-auto basis-2/6">Выберете организацию</p>
                        <p className="w-full p-2 rounded-lg border text-center bg-gray-100 hover:bg-gray-200 hover:text-indigo-500">
                            Выбрать</p>
                    </div>
                    <div className="flex pb-4 mb-4">
                        <p className="text-lg my-auto basis-2/6">Укажите дату отправки</p>
                        <input type="date" className="rounded-lg w-full"/>
                    </div>
                    <div className="flex pb-4 mb-4">
                        <p className="text-lg my-auto basis-2/6">Добавьте необходимые марки</p>
                        <ButtonRounded caption="Добавить" svg={<Plus24/>} class={'rounded-button-secondary'}/>
                    </div>
                    <div className="flex border bg-gray-100 p-4 rounded-lg">
                        <p>stamps</p>
                    </div>
                </div>
            </div>
        );
    }
}

export default OutgoingStore;
