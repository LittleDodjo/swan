import React, {Component} from 'react';
import {Navigate} from 'react-router-dom';

class AuthorizeView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            isError: false,
            isLoading: false,
            isSuccess: false,
            login : "soave99",
            password: "123456",
        }
        this.handleChange = this.handleChange.bind(this);
        this.handleClick = this.handleClick.bind(this);
        this.handleStatus = this.handleStatus.bind(this);
    }

    handleChange(e){
        const target = e.target;
        const value = target.value;
        const name = target.name;
        this.setState({[name] : value});
    }

    handleClick(e){
        e.preventDefault();
        this.setState({isLoading : true});
        const authProvider = this.props.authProvider;
        authProvider.authorize(this.state.login, this.state.password, this.handleStatus);
    }

    handleStatus(data){
        console.log(data);
        this.setState({isLoading: false});
        if(data.code === 200){
            this.setState({isSuccess: true, isError: false});
            this.props.saveUser(data.token, data.user);
        }else{
            this.setState({isError: true});
        }
    }

    render() {
        return (
            // <Navigate to='/app' replace />
            <div className="flex h-screen flex-col items-center justify-center bg-slate-100">
                <div className="my-4">
                    <h1 className="text-3xl font-light">Добро пожаловать в веб-интерфейс лебедь</h1>
                </div>
                <div className="flex flex-col rounded-xl border border-slate-300 bg-white p-4 shadow-md">
                    <div className="my-2 mx-auto">
                        <h1 className="text-xl font-light">Авторизация</h1>
                    </div>
                    <div className="my-2">
                        <input type="text" name="login" id="login" placeholder="Введите логин" value={this.state.login} onChange={this.handleChange}/>
                    </div>
                    <div className="my-2">
                        <input type="password" name="password" id="password" placeholder="Введите пароль" value={this.state.password} onChange={this.handleChange}/>
                    </div>
                    <div className="my-2 mx-auto">
                        <input type="button" value="Войти" className="rounded-lg border border-slate-400 px-6 py-2" onClick={this.handleClick}/>
                    </div>
                    {this.state.isLoading ?
                        <h1>loading</h1>
                        :""}
                </div>
                {this.state.isError ?
                    <div className="my-4">
                        <h1 className="text-red-400">Ошибка авторизации</h1>
                    </div>
                :""}
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
