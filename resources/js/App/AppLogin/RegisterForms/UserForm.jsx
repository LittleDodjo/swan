import React, {Component} from 'react';
import Loading24 from "../../Common/Resources/Loading24";
import SvgInput from "../Components/SvgInput";
import User24 from "../../Common/Resources/User24";
import Lock24 from "../../Common/Resources/Lock24";
import BaseButton from "../Components/BaseButton";
import {toast} from "react-hot-toast";
import AuthServiceProvider from "../../Providers/AuthServiceProvider";

class UserForm extends Component {

    constructor(props) {
        super(props);

        this.state = {
            loading: false,
            login: "",
            password: "",
            password_confirmation: "",
        };

        this.handleStep = this.handleStep.bind(this);
        this.handleInput = this.handleInput.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }


    handleInput(e) {
        this.setState({[e.target.name]: e.target.value})
    }

    handleSubmit() {
        this.setState({loading: true});
        const provider = new AuthServiceProvider();
        provider.register(
            this.state.login,
            this.state.password,
            this.state.password_confirmation,
            this.props.employee(),
            this.handleStep,
        );
    }

    handleStep(data) {
        this.setState({loading: false});
        if (data.code === 200) {
            this.props.action();
            toast.success("Регистрация прошла успешно");
        } else {
            toast.error("Ошибка регистрации");
        }
    }


    render() {
        return (
            <>
                <div className="my-auto">
                    <h1 className="text-3xl font-light text-white">Создание учетной записи</h1>
                </div>
                <div className="flex flex-col my-10 justify-center">
                    <SvgInput data={this.state.login} handleChange={this.handleInput} name="login"
                              svg={<User24/>}
                              placeholder="Придумайте логин" type="text"/>
                    <SvgInput data={this.state.password} handleChange={this.handleInput} name="password"
                              svg={<Lock24/>}
                              placeholder="Придумайте пароль" type="password"/>
                    <SvgInput data={this.state.password_confirmation} handleChange={this.handleInput}
                              name="password_confirmation"
                              svg={<Lock24/>}
                              placeholder="Повторите пароль" type="password"/>
                    <BaseButton class="my-4" action={this.handleSubmit} value="Регистрация"/>
                </div>
                {this.state.loading ? <Loading24/> : ""}
            </>
        );
    }
}

export default UserForm;
