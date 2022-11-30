import React, {Component} from 'react';

class App extends Component {

    constructor(props) {
        super(props);

    }

    render() {
        return (
            <>
                <div className="relative flex h-screen w-screen flex-col bg-slate-100">

                    <div className="flex w-full flex-col items-center">
                        <img
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/Coat_of_arms_of_Chelyabinsk_Oblast.svg/1200px-Coat_of_arms_of_Chelyabinsk_Oblast.svg.png"
                            alt="" className="w-44"/>
                        <h1 className="mt-5 mb-4 text-2xl font-light">Министерство социальных отношений Челябинской
                            области</h1>
                    </div>
                    <div className="flex w-full flex-col border-y bg-white py-10 text-center shadow-lg">
                        <h1 className="mb-4 text-xl font-light">Авторизация</h1>
                        <div className="mx-auto flex flex-col justify-center">
                            <div className="relative flex">
                                <div className="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg className="fill-slate-500" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z"/>
                                        <path
                                            d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"/>
                                    </svg>
                                </div>
                                <input type="text" placeholder="Введите логин" name="" id="" className="edit"/>
                            </div>
                            <div className="relative flex">
                                <div
                                    className="pointer-events-none absolute inset-y-0 left-0 flex items-center fill-slate-500 pl-3 focus:fill-indigo-500">
                                    <svg className="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                         height="24">
                                        <path fill="none" d="M0 0h24v24H0z"/>
                                        <path
                                            d="M18 8h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h2V7a6 6 0 1 1 12 0v1zM5 10v10h14V10H5zm6 4h2v2h-2v-2zm-4 0h2v2H7v-2zm8 0h2v2h-2v-2zm1-6V7a4 4 0 1 0-8 0v1h8z"/>
                                    </svg>
                                </div>
                                <input type="password" placeholder="Введите пароль" name="" id="" className="edit"/>
                            </div>
                            <div className="flex justify-between">
                                <div className="my-auto mx-2">
                                    <input id="default-checkbox" type="checkbox" value=""
                                           className="h-4 w-4 rounded-full border-gray-300 bg-gray-100 p-2 text-indigo-500 focus:ring-1 focus:ring-indigo-500"/>
                                    <label htmlFor="default-checkbox"
                                           className="my-auto ml-2 font-light text-gray-900 dark:text-gray-300">Запомнить
                                        меня</label>
                                </div>
                                <div className="button">
                                    <div className="">
                                        <svg className="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                             width="24" height="24">
                                            <path fill="none" d="M0 0h24v24H0z"/>
                                            <path
                                                d="M4 15h2v5h12V4H6v5H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6zm6-4V8l5 4-5 4v-3H2v-2h8z"/>
                                        </svg>
                                    </div>
                                    <input className="mx-2" type="button" value="Войти"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="mx-auto my-4 flex">
                        <p className="link">Регистрация</p>
                    </div>

                    <div className="absolute bottom-0 w-screen text-center">
                        <h1 className="text-sm font-light text-slate-400">Лицензия действует до 30.01.2023 года,
                            предоставлена Министерству социальных отношений Челябинской области.</h1>
                        <p className="text-xs font-light text-slate-500">Данный веб-узел преодставляет возможность
                            пользоваться приложением электронного документооборота "Лебедь"</p>
                    </div>
                </div>

            </>
        );
    }
}

export default App;

// <div className="absolute z-10 h-screen w-screen backdrop-blur-md transition-all delay-75">
//     <div className="flex h-full w-full flex-col">
//         <div className="my-auto p-5">
//             <div className="text-center">
//                 <h1 className="my-4 text-3xl font-light">Регистрация</h1>
//             </div>
//             <div className="mx-4 p-4">
//                 <div className="flex items-center">
//                     <div className="relative flex items-center text-indigo-600">
//                         <div
//                             className="h-12 w-12 rounded-full border-2 border-indigo-600 py-3 transition duration-500 ease-in-out">
//                             <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
//                                  fill="none" viewBox="0 0 24 24" stroke="currentColor"
//                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
//                                  className="feather feather-bookmark">
//                                 <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
//                             </svg>
//                         </div>
//                         <div
//                             className="absolute top-0 -ml-10 mt-16 w-32 text-center text-xs font-medium uppercase text-indigo-600">Учентые
//                             данные
//                         </div>
//                     </div>
//                     <div
//                         className="flex-auto border-t-2 border-indigo-600 transition duration-500 ease-in-out"></div>
//                     <div className="relative flex items-center text-white">
//                         <div
//                             className="h-12 w-12 rounded-full border-2 border-indigo-600 bg-indigo-600 py-3 transition duration-500 ease-in-out">
//                             <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
//                                  fill="none" viewBox="0 0 24 24" stroke="currentColor"
//                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
//                                  className="feather feather-user-plus">
//                                 <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
//                                 <circle cx="8.5" cy="7" r="4"></circle>
//                                 <line x1="20" y1="8" x2="20" y2="14"></line>
//                                 <line x1="23" y1="11" x2="17" y2="11"></line>
//                             </svg>
//                         </div>
//                         <div
//                             className="absolute top-0 -ml-10 mt-16 w-32 text-center text-xs font-medium uppercase text-indigo-600">Аккаунт
//                         </div>
//                     </div>
//                     <div
//                         className="flex-auto border-t-2 border-gray-300 transition duration-500 ease-in-out"></div>
//                     <div className="relative flex items-center text-gray-500">
//                         <div
//                             className="h-12 w-12 rounded-full border-2 border-gray-300 py-3 transition duration-500 ease-in-out">
//                             <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
//                                  fill="none" viewBox="0 0 24 24" stroke="currentColor"
//                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
//                                  className="feather feather-mail">
//                                 <path
//                                     d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
//                                 <polyline points="22,6 12,13 2,6"></polyline>
//                             </svg>
//                         </div>
//                         <div
//                             className="absolute top-0 -ml-10 mt-16 w-32 text-center text-xs font-medium uppercase text-gray-500">Специализация
//                         </div>
//                     </div>
//                     <div
//                         className="flex-auto border-t-2 border-gray-300 transition duration-500 ease-in-out"></div>
//                     <div className="relative flex items-center text-gray-500">
//                         <div
//                             className="h-12 w-12 rounded-full border-2 border-gray-300 py-3 transition duration-500 ease-in-out">
//                             <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
//                                  fill="none" viewBox="0 0 24 24" stroke="currentColor"
//                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
//                                  className="feather feather-database">
//                                 <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
//                                 <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
//                                 <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
//                             </svg>
//                         </div>
//                         <div
//                             className="absolute top-0 -ml-10 mt-16 w-32 text-center text-xs font-medium uppercase text-gray-500">Регистрация
//                         </div>
//                     </div>
//                 </div>
//             </div>
//
//         </div>
//     </div>
// </div>
