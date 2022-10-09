import React, {Component} from 'react';

class AuthorizeView extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="flex h-screen flex-col items-center justify-center bg-slate-100">
                <div className="my-4">
                    <h1 className="text-3xl font-light">Добро пожаловать в веб-интерфейс лебедь</h1>
                </div>
                <div className="flex flex-col rounded-xl border border-slate-300 bg-white p-4 shadow-md">
                    <div className="my-2 mx-auto">
                        <h1 className="text-xl font-light">Авторизация</h1>
                    </div>
                    <div className="my-2">
                        <input type="text" name="login" id="" placeholder="Введите логин"/>
                    </div>
                    <div className="my-2">
                        <input type="password" name="login" id="" placeholder="Введите пароль"/>
                    </div>
                    <div className="my-2 mx-auto">
                        <input type="button" value="Войти" className="rounded-lg border border-slate-400 px-6 py-2"/>
                    </div>
                </div>
            </div>
        );
    }
}

export default AuthorizeView;

///flex h-screen flex-col items-center justify-center bg-slate-100 *
//flex h-screen w-screen flex-row overflow-hidden bg-slate-100 <-
// <div className="absolute bottom-0 mb-4 cursor-pointer">
//     <h1 className="text-slate-400 text-xs font-light">
//         Веб-интерфейс программной среды Лебедь. <span
//         className="text-slate-500 underline hover:text-indigo-500">лицензия</span>, версия - 1.0,
//         идентификатор
//         - 8bcGHasjqJAWINCDc
//     </h1>
// </div>
