import React, {Component} from 'react';
import AuthProvider from "../../AppProvider/AuthProvider";
import LogoComponent from "../Common/LogoComponent";
import InputComponent from "../Common/InputComponent";
import SubmitForm from "../Common/SubmitForm";
import SwapWindow from "../Common/SwapWindow";
import CardCaption from "../Common/CardCaption";
import MainCard from "../Common/MainCard";
import {toast} from "react-toastify";
import Notify from "../../Notify";


class AuthorizeView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            isLoading: false,
            isSuccess: false,
            login: "",
            password: "",
        }
        this.handleChange = this.handleChange.bind(this);
        this.handleClick = this.handleClick.bind(this);
        this.handleStatus = this.handleStatus.bind(this);
    }

    handleChange(inputData, inputName) {
        this.setState({[inputName]: inputData});
    }

    handleClick(e) {
        e.preventDefault();
        this.setState({isLoading: true});
        const authProvider = new AuthProvider();
        authProvider.authorize(this.state.login, this.state.password, this.handleStatus);
    }

    handleStatus(data) {
        this.setState({isLoading: false});
        if (data.code === 200) {
            this.setState({isSuccess: true, isError: false});
            this.props.willAuth(true);
            const appProvider = this.props.appProvider;
            appProvider.saveAuth(data.token, data.user);
            toast.success(<Notify text={"Добрый день, " + data.user.first_name}/>, {autoClose : 1000 });

        } else {
            this.setState({isLoading: false});
            toast.error(<Notify text="Ошибка авторизации"/>, {autoClose : 1000 });
        }
    }

    componentDidMount() {

    }

    render() {
        return (
            <>
                <LogoComponent/>
                <MainCard>
                    <CardCaption caption="Авторизация"/>
                    <InputComponent placeholder="Введите логин" type="text" name="login" handle={this.handleChange}/>
                    <InputComponent placeholder="Введите пароль" type="password" name="password"
                                    handle={this.handleChange}/>
                    <SubmitForm isLoading={this.state.isLoading} action={this.handleClick} value="Войти" isRemember={true}/>
                </MainCard>
                <SwapWindow caption="Если у вас нет аккаунта вы можете " data="зарегестрироваться" link="register/"/>
            </>
        );
    }
}

export default AuthorizeView;
