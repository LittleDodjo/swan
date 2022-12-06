import React, {Component} from 'react';
import Sidebar from "./SidebarView";
import UserServiceProvider from "../Providers/UserServiceProvider";

class MainAppView extends Component {

    constructor(props) {
        super(props);
        this.state = {};

        this.user = this.user.bind(this);
    }

    //Получить полные данные об учетной записи
    user() {
        const userProvider = new UserServiceProvider();
        return userProvider.me();
    }

    componentDidMount() {
        console.log("test");
    }

    render() {
        return (
            <div className="subsystem-base">

                <Sidebar/>
                <main className="main-subsystem-base">
                    <div className="flex h-full flex-col bg-red-200">
                        <div className="flex flex-row border-b border-slate-300 bg-white">
                            <div className="m-4 w-fit rounded-full border bg-slate-100 p-4 ring-2"><h1
                                className="text-2xl">ОГ</h1></div>
                            <div className="flex w-fit flex-col justify-center">
                                <h1 className="text-xl">Гуськов Олег Олегович</h1>
                                <p className="text-xs font-light text-slate-400">Руководитель отдела по сопроводу инф
                                    систем</p>
                            </div>
                            <div className="my-auto mx-10 flex">
                                <p className="mx-2 rounded-full border border-green-300 bg-green-100 p-2 text-xs font-light">Администратор</p>
                                <p className="mx-2 rounded-full border border-sky-300 bg-sky-100 p-2 text-xs font-light">Суперпользователь</p>
                                <p className="mx-2 rounded-full border border-red-300 bg-red-100 p-2 text-xs font-light">Конотролирующий
                                    персонал</p>
                                <p className="mx-2 rounded-full border border-fuchsia-300 bg-fuchsia-100 p-2 text-xs font-light">Доступ
                                    к персональным данным</p>
                                <p className="mx-2 rounded-full border border-slate-300 bg-slate-100 p-2 text-xs font-light">Руководитель</p>
                            </div>
                        </div>
                        <div className="flex flex-row border-b bg-white hover:cursor-pointer">
                            <div
                                className="w-full border-b-2 border-indigo-500 px-4 text-center hover:bg-slate-50 hover:text-indigo-500">
                                <p className="text-lg font-light">Основное</p>
                            </div>
                            <div className="w-full px-4 text-center hover:bg-slate-50 hover:text-indigo-500">
                                <p className="text-lg font-light">Настройки</p>
                            </div>
                            <div className="w-full px-4 text-center hover:bg-slate-50 hover:text-indigo-500">
                                <p className="text-lg font-light">Администрирование</p>
                            </div>
                        </div>
                        <div className="flex h-full flex-col bg-slate-50">
                            <div className="flex justify-between">
                                <h1 className="mx-4 my-4 text-3xl font-light">Есть ограничения</h1>
                            </div>
                            <div className="border-y bg-white py-4">
                                <div
                                    className="mx-4 flex rounded-lg border border-indigo-500 bg-slate-50 p-4 backdrop-blur-lg">
                                    <h1 className="font-light">Ваша учетная запись не подтверждена, в связи с этим
                                        доступный вам функционал временно ограничен. Для подтверждения учетной записи
                                        обратитесь к администратору. Данное сообщение исчезнет, когда ваша учетная
                                        запись будет подтверждена.</h1>
                                </div>

                                <div
                                    className="mx-4 mt-4 flex rounded-lg border border-indigo-500 bg-slate-50 p-4 backdrop-blur-lg">
                                    <h1 className="font-light">Ваш профиль заполнен не до конца</h1>
                                </div>
                            </div>

                            <div className="flex justify-between">
                                <h1 className="mx-4 my-4 text-3xl font-light">Данные профиля <span
                                    className="cursor-pointer text-indigo-500">@soave99</span></h1>
                            </div>

                            <div className="my-4 flex flex-col border-y bg-white p-4">
                                <div className="flex flex-row">
                                    <div className="mx-4 my-4 flex w-full flex-col">
                                        <p className="text-sm font-light text-slate-600">Наименование организации</p>
                                        <h1>Министерство социальных отношений Челябинской области, Минсоцотношений</h1>
                                    </div>
                                    <div className="mx-4 my-4 flex w-full flex-col">
                                        <p className="text-sm font-light text-slate-600">Корпоративная почта</p>
                                        <h1>soave99@bk.ru</h1>
                                    </div>
                                </div>

                                <div className="flex flex-row">
                                    <div className="mx-4 my-4 flex w-full flex-col">
                                        <p className="text-sm font-light text-slate-600">Отдел, кабинет</p>
                                        <h1>Отдел по споровождению информационных систем, 40</h1>
                                    </div>
                                    <div className="mx-4 my-4 flex w-full flex-col">
                                        <p className="text-sm font-light text-slate-600">Логин</p>
                                        <h1>@soave99</h1>
                                    </div>
                                </div>
                            </div>

                            <div className="flex h-full flex-col bg-slate-50">
                                <div className="flex justify-between">
                                    <h1 className="mx-4 my-4 text-3xl font-light">Зависимости</h1>
                                </div>
                                <div className="my-4 flex flex-col border-y bg-white p-4">
                                    <p className="my-1 text-sm font-light">Ваш отдел подчиняется управлению:</p>
                                    <div
                                        className="flex cursor-pointer flex-col rounded-md border border-slate-400 bg-white p-4 shadow-md hover:border-indigo-500">
                                        <h1 className="text-xl font-light">Управление социальной защиты населения
                                            Минсоцотношений</h1>
                                        <div className="mt-2">
                                            <p className="text-sm font-light text-slate-500">Руководитель</p>
                                            <h1 className="font-light">Расчектаева Людмила Николаевна, 67 каб., тел.
                                                402-12-23</h1>
                                        </div>
                                    </div>
                                    <p className="my-1 mt-2 text-sm font-light">Вы руководитель отдела</p>
                                    <div
                                        className="flex cursor-pointer flex-col rounded-md border border-slate-400 bg-white p-4 shadow-md hover:border-indigo-500">
                                        <h1 className="text-xl font-light">Отдел по сопровождению информационных
                                            систем</h1>
                                        <div className="mt-2">
                                            <p className="text-sm font-light text-slate-500">Руководитель</p>
                                            <h1 className="font-light">Гуськов Олег Олегович, 42 каб., тел.
                                                232-41-77</h1>
                                        </div>
                                        <div className="mt-2">
                                            <p className="text-sm font-light text-slate-500">Заместитель</p>
                                            <h1 className="font-light">Малева Татьяна Валерьевна, 42 каб., тел.
                                                231-24-88</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        );
    }
}

export default MainAppView;
