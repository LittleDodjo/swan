import React, {Component} from 'react';

class OutgoingDocument extends Component {


    constructor(props) {
        super(props);
        this.state = {
            data : {
                //... table
            }
        }
    }

    componentDidMount() {

    }

    render() {
        return (
            <main className="overflow-x-clip1 flex h-full w-full flex-col overflow-y-auto">


                <div className="mx-4 my-4 flex">
                    <h1 className="text-2xl font-light">Карточки исходящих документов</h1>
                    <p className="my-auto mx-4 text-2xl underline underline-offset-4 font-light text-indigo-500">4</p>
                </div>



                <div className="flex w-full flex-col">
                    <div className="mx-4 my-2 flex flex-col rounded-xl border bg-white p-4 shadow-sm">
                        <div className="flex w-full justify-between border-b pb-2">
                            <div className="flex">
                                <h1 className="my-auto mr-4 text-lg font-light">Рег №</h1>
                                <p className="my-auto text-indigo-500 underline underline-offset-4">51224</p>
                                <h1 className="my-auto ml-4 mr-4 text-lg font-light">№ Исходящего</h1>
                                <p className="my-auto text-indigo-500 underline underline-offset-4">15-7325-С</p>
                            </div>
                            <div className="flex">
                                <div
                                    className="mr-2 flex cursor-pointer fill-slate-400 text-slate-400 hover:fill-indigo-500 hover:text-indigo-500">
                                    <p className="font-light">дата отправления</p>
                                    <p className="px-4 font-light">12.09.2022</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z"/>
                                        <path
                                            d="M17 3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4V1h2v2h6V1h2v2zm3 8H4v8h16v-8zm-5-6H9v2H7V5H4v4h16V5h-3v2h-2V5zm-9 8h2v2H6v-2zm5 0h2v2h-2v-2zm5 0h2v2h-2v-2z"/>
                                    </svg>
                                </div>
                                <div
                                    className="flex cursor-pointer fill-slate-400 text-slate-400 hover:fill-indigo-500 hover:text-indigo-500">
                                    <p className="font-light">дата исходящего</p>
                                    <p className="px-4 font-light">12.09.2022</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z"/>
                                        <path
                                            d="M17 3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4V1h2v2h6V1h2v2zm3 8H4v8h16v-8zm-5-6H9v2H7V5H4v4h16V5h-3v2h-2V5zm-9 8h2v2H6v-2zm5 0h2v2h-2v-2zm5 0h2v2h-2v-2z"/>
                                    </svg>
                                </div>
                                <div
                                    className="flex cursor-pointer fill-slate-400 text-slate-400 hover:fill-indigo-500 hover:text-indigo-500">
                                    <p className="font-light">дата отправления</p>
                                    <p className="px-4 font-light">12.09.2022</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z"/>
                                        <path
                                            d="M17 3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4V1h2v2h6V1h2v2zm3 8H4v8h16v-8zm-5-6H9v2H7V5H4v4h16V5h-3v2h-2V5zm-9 8h2v2H6v-2zm5 0h2v2h-2v-2zm5 0h2v2h-2v-2z"/>
                                    </svg>
                                </div>
                                <div
                                    className="ml-2 flex cursor-pointer fill-slate-400 text-slate-400 hover:fill-indigo-500 hover:text-indigo-500">
                                    <p className="font-light">дата э/п</p>
                                    <p className="px-4 font-light">12.09.2022</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z"/>
                                        <path
                                            d="M17 3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4V1h2v2h6V1h2v2zm3 8H4v8h16v-8zm-5-6H9v2H7V5H4v4h16V5h-3v2h-2V5zm-9 8h2v2H6v-2zm5 0h2v2h-2v-2zm5 0h2v2h-2v-2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div className="my-4 flex">
                            <div className="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M20 22H4a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1zm-1-2V4H5v16h14zM8 7h8v2H8V7zm0 4h8v2H8v-2zm0 4h8v2H8v-2z"/>
                                </svg>
                                <p className="px-2">Тип отправления: <span
                                    className="text-indigo-500 underline underline-offset-4">простое</span></p>
                            </div>
                            <div className="ml-4 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"/>
                                </svg>
                                <p className="px-2">Исполнитель: <span
                                    className="ml-2 text-indigo-500 underline underline-offset-4">Литвина М.Э.</span>
                                </p>
                            </div>
                            <div className="ml-4 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"/>
                                </svg>
                                <p className="px-2">Кому: <span
                                    className="ml-2 text-indigo-500 underline underline-offset-4">Сухановой И.А.</span>
                                </p>
                            </div>
                            <div className="ml-4 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M12 23.728l-6.364-6.364a9 9 0 1 1 12.728 0L12 23.728zm4.95-7.778a7 7 0 1 0-9.9 0L12 20.9l4.95-4.95zM12 13a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                                </svg>
                                <p className="px-2">Куда: <span
                                    className="ml-2 text-indigo-500 underline underline-offset-4">ГР</span></p>
                            </div>
                            <div className="ml-4 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M2.243 6.854L11.49 1.31a1 1 0 0 1 1.029 0l9.238 5.545a.5.5 0 0 1 .243.429V20a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.283a.5.5 0 0 1 .243-.429zM4 8.133V19h16V8.132l-7.996-4.8L4 8.132zm8.06 5.565l5.296-4.463 1.288 1.53-6.57 5.537-6.71-5.53 1.272-1.544 5.424 4.47z"/>
                                </svg>
                                <p className="px-2">Конвертов: <span
                                    className="ml-2 text-indigo-500 underline underline-offset-4">0</span></p>
                            </div>
                            <div className="ml-4 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M2.243 6.854L11.49 1.31a1 1 0 0 1 1.029 0l9.238 5.545a.5.5 0 0 1 .243.429V20a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.283a.5.5 0 0 1 .243-.429zM4 8.133V19h16V8.132l-7.996-4.8L4 8.132zm8.06 5.565l5.296-4.463 1.288 1.53-6.57 5.537-6.71-5.53 1.272-1.544 5.424 4.47z"/>
                                </svg>
                                <p className="px-2">Марок: <span
                                    className="ml-2 text-indigo-500 underline underline-offset-4">0</span></p>
                            </div>
                            <div className="ml-4 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M2.243 6.854L11.49 1.31a1 1 0 0 1 1.029 0l9.238 5.545a.5.5 0 0 1 .243.429V20a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.283a.5.5 0 0 1 .243-.429zM4 8.133V19h16V8.132l-7.996-4.8L4 8.132zm8.06 5.565l5.296-4.463 1.288 1.53-6.57 5.537-6.71-5.53 1.272-1.544 5.424 4.47z"/>
                                </svg>
                                <p className="px-2">Вид отправки: <span
                                    className="ml-2 text-indigo-500 underline underline-offset-4">ответ</span></p>
                            </div>
                            <div className="ml-4 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M2.243 6.854L11.49 1.31a1 1 0 0 1 1.029 0l9.238 5.545a.5.5 0 0 1 .243.429V20a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.283a.5.5 0 0 1 .243-.429zM4 8.133V19h16V8.132l-7.996-4.8L4 8.132zm8.06 5.565l5.296-4.463 1.288 1.53-6.57 5.537-6.71-5.53 1.272-1.544 5.424 4.47z"/>
                                </svg>
                                <p className="px-2">Вид конверта: <span
                                    className="ml-2 text-indigo-500 underline underline-offset-4">нет</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        );
    }
}

export default OutgoingDocument;

// <div className="flex w-full">
//     <input className="mx-4 my-2 w-full rounded-full border py-2 px-4 focus:ring-0"
//            placeholder="Начните вводить для поиска" type="text" name="" id=""/>
//     <div className="flex">
//         <input className="filter-btn" type="button" value="Рег. №"/>
//         <input className="filter-btn" type="button" value="Исполнитель"/>
//         <input className="filter-btn" type="button" value="Адресат"/>
//         <input className="filter-btn" type="button" value="Отдел"/>
//         <input className="filter-btn" type="button" value="Дата отправления"/>
//         <input className="filter-btn" type="button" value="Исх. Дата"/>
//     </div>
// </div>