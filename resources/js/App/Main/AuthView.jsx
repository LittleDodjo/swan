//Авторизация
import React, {Component} from 'react';
import MainView from "./MainView";
import RegisterView from "./RegisterView";
import MainLogo from "./Components/MainLogo";
import Copyright from "./Components/Copyright";
import User24 from "../Common/Resources/User24";
import SvgInput from "../Common/SvgInput";
import Lock24 from "../Common/Resources/Lock24";
import BaseCheckbox from "../Common/BaseCheckbox";
import BaseButton from "../Common/BaseButton";
import BaseLink from "../Common/BaseLink";
import AuthServiceProvider from "../Providers/AuthServiceProvider";
import {toast} from 'react-hot-toast';
import AppServiceProvider from "../Providers/AppServiceProvider";
import CookieProvider from "../Providers/CookieProvider";

class AuthView extends Component {

    constructor(props) {
        super(props);

        this.state = {
            isRegister: false,
            isLoading: false,
            login: "",
            password: "",
            remember: false,
        };

        this.openRegister = this.openRegister.bind(this);
        this.handleInput = this.handleInput.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleAuth = this.handleAuth.bind(this);
    }

    openRegister() {
        this.setState({isRegister: !this.state.isRegister})
    }

    handleInput(e) {
        const target = e.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;
        this.setState({[name]: value});
    }

    handleSubmit(e) {
        this.setState({isLoading: true});
        const provider = new AuthServiceProvider();
        provider.login(this.state.login, this.state.password, this.handleAuth);
    }

    handleAuth(data) {
        this.setState({isLoading: false});
        if(data.code === 200) {
            const Auth = new AppServiceProvider();
            if(this.state.remember) {
                Auth.saveRemember(this.state.login, this.state.password);
            }
            Auth.saveAuth(data.headers, data.data, this.state.remember);
            this.props.action(true);
            toast.success("Авторизация успешна!");
        }
        else {
            toast.error("Ошибка авторизации");
        }
    }

    componentDidMount() {
        const cookieProvider = new CookieProvider();
        if(cookieProvider.issetLocal('remember')){
            this.setState({
                login : cookieProvider.readLocal('login'),
                password : cookieProvider.readLocal('password'),
                remember : cookieProvider.readLocal('remember'),
            })
        }
    }

    render() {
        return (
            <>
                <MainView>
                    {this.state.isRegister ? <RegisterView close={this.openRegister}/> : <></>}
                    <MainLogo/>
                    <div className="flex w-full flex-col border-y bg-white py-10 text-center shadow-lg">
                        <h1 className="mb-4 text-xl font-light">Авторизация</h1>
                        <div className="mx-auto flex flex-col justify-center">
                            <SvgInput data={this.state.login} handleChange={this.handleInput} name="login" svg={<User24/>}
                                      placeholder="Введите логин" type="text"/>
                            <SvgInput data={this.state.password} handleChange={this.handleInput} name="password" svg={<Lock24/>}
                                      placeholder="Введите пароль" type="password"/>
                            <div className="flex justify-between">
                                <div className="my-auto mx-2">
                                    <BaseCheckbox data={this.state.remember} name="remember" handleChange={this.handleInput}
                                                  value="Запомнить меня"/>
                                </div>
                                <BaseButton action={this.handleSubmit} value="Войти"/>
                            </div>
                        </div>
                        <BaseLink value="Регистрация" action={this.openRegister}/>
                        <Copyright/>
                    </div>
                    {this.state.isLoading ? "loading!" : ""}
                </MainView>
            </>
        );
    }
}

export default AuthView;
