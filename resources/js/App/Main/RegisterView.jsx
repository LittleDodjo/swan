import React, {Component} from 'react';

class RegisterView extends Component {
    render() {
        return (
            <div className="absolute z-10 h-screen w-screen backdrop-blur-md transition-all delay-75">
                <div className="flex h-full w-full flex-col">
                    <div className="my-auto p-5">
                        <div className="text-center">
                            <h1 className="my-4 text-3xl font-light">Регистрация</h1>
                        </div>
                        <div className="mx-4 p-4">
                            <div className="flex items-center">
                                <div className="relative flex items-center text-indigo-600">
                                    <div
                                        className="h-12 w-12 rounded-full border-2 border-indigo-600 py-3 transition duration-500 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             className="feather feather-bookmark">
                                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                    </div>
                                    <div
                                        className="absolute top-0 -ml-10 mt-16 w-32 text-center text-xs font-medium uppercase text-indigo-600">Учентые
                                        данные
                                    </div>
                                </div>
                                <div
                                    className="flex-auto border-t-2 border-indigo-600 transition duration-500 ease-in-out"></div>
                                <div className="relative flex items-center text-white">
                                    <div
                                        className="h-12 w-12 rounded-full border-2 border-indigo-600 bg-indigo-600 py-3 transition duration-500 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             className="feather feather-user-plus">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="8.5" cy="7" r="4"></circle>
                                            <line x1="20" y1="8" x2="20" y2="14"></line>
                                            <line x1="23" y1="11" x2="17" y2="11"></line>
                                        </svg>
                                    </div>
                                    <div
                                        className="absolute top-0 -ml-10 mt-16 w-32 text-center text-xs font-medium uppercase text-indigo-600">Аккаунт
                                    </div>
                                </div>
                                <div
                                    className="flex-auto border-t-2 border-gray-300 transition duration-500 ease-in-out"></div>
                                <div className="relative flex items-center text-gray-500">
                                    <div
                                        className="h-12 w-12 rounded-full border-2 border-gray-300 py-3 transition duration-500 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             className="feather feather-mail">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                    </div>
                                    <div
                                        className="absolute top-0 -ml-10 mt-16 w-32 text-center text-xs font-medium uppercase text-gray-500">Специализация
                                    </div>
                                </div>
                                <div
                                    className="flex-auto border-t-2 border-gray-300 transition duration-500 ease-in-out"></div>
                                <div className="relative flex items-center text-gray-500">
                                    <div
                                        className="h-12 w-12 rounded-full border-2 border-gray-300 py-3 transition duration-500 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             className="feather feather-database">
                                            <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                                        </svg>
                                    </div>
                                    <div
                                        className="absolute top-0 -ml-10 mt-16 w-32 text-center text-xs font-medium uppercase text-gray-500">Регистрация
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        );
    }
}

export default RegisterView;
