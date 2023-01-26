import React, {Component} from 'react';

class OutgoingDocumentBody extends Component {

    constructor(props) {
        super(props);


    }



    render() {
        return (
            <div className="flex flex-col">
                <div className="flex flex-col divide-y bg-white shadow-md border border-gray-400 m-4 rounded-xl">
                    <div className="flex cursor-pointer">
                        <h1 className="text-xl  m-4">Простое заказное письмо, маркированое</h1>
                        <p className="px-4 my-auto border border-indigo-200 py-2 rounded-lg bg-slate-50 cursor-pointer mx-2">от 20.01.2023 г.</p>
                        <h1 className="text-xl  m-4">На основании документа №2123-НЯ-ПЯ</h1>
                        <p className="px-4 my-auto border border-indigo-200 py-2 rounded-lg bg-slate-50 cursor-pointer mx-2">от 12.01.2023 г.</p>
                    </div>

                    <div className="flex flex-col cursor-pointer">
                        <div className="flex flex-col divide-y">
                            <div className="divide-x flex">
                                <div className="w-full p-4">Количество листов</div>
                                <div className="w-full p-4 text-center">1 шт.</div>
                                <div className="w-full p-4">Количество экземпляров</div>
                                <div className="w-full p-4 text-center">1 шт.</div>
                                <div className="w-full p-4">Количество конвертов</div>
                                <div className="w-full p-4 text-center">1 шт.</div>
                            </div>
                        </div>
                    </div>



                </div>

                <div className="flex flex-col divide-y bg-white shadow-md border border-gray-400 m-4 rounded-xl">
                    <div className="flex">
                        <h1 className="text-xl m-4">Документ направлен нескольким адресатам</h1>
                        <p className="px-4 my-auto border border-indigo-200 py-2 rounded-lg bg-slate-50 cursor-pointer mx-2">12.01.2023 г.</p>
                    </div>
                    <div className="flex flex-col divide-y">
                        <div className="divide-x flex">
                            <div className="w-full p-4">Гражданину</div>
                            <div className="w-full p-4">454000, г. Челябинск, пр. Ленина, д.36, кв. 24</div>
                        </div>
                        <div className="divide-x flex">
                            <div className="w-full p-4">Электронной почтой</div>
                            <div className="w-full p-4">soave99@bk.ru</div>
                        </div>
                        <div className="divide-x flex">
                            <div className="w-full p-4">В организацию</div>
                            <div className="w-full p-4">454000, г. Челябинск, пр. Ленина, д.36, кв. 24</div>
                        </div>
                    </div>
                </div>

                <div className="flex flex-col divide-y bg-white shadow-md border border-gray-400 m-4 rounded-xl">
                    <div className="flex">
                        <h1 className="text-xl m-4">Использовано марок</h1>
                        <p className="px-4 my-auto border border-indigo-200 py-2 rounded-lg bg-slate-50 cursor-pointer mx-2">15 шт.</p>
                    </div>
                    <div className="flex flex-col divide-y">
                        <div className="divide-x flex">
                            <div className="w-full p-4">Номинал 1.5 руб.</div>
                            <div className="w-full p-4">5 шт.</div>
                        </div>
                        <div className="divide-x flex">
                            <div className="w-full p-4">Номинал 56 руб.</div>
                            <div className="w-full p-4">1 шт</div>
                        </div>
                        <div className="divide-x flex">
                            <div className="w-full p-4">Номинал 3 руб</div>
                            <div className="w-full p-4">9 шт.</div>
                        </div>
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
