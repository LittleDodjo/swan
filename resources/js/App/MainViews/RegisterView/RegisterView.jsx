import React, {Component} from 'react';
import { toast } from 'react-toastify';
import "react-toastify/dist/ReactToastify.css";
import AuthProvider from "../../AppProvider/AuthProvider";
import LogoComponent from "../Common/LogoComponent";
import InputComponent from "../Common/InputComponent";
import SubmitForm from "../Common/SubmitForm";
import SwapWindow from "../Common/SwapWindow";
import CardCaption from "../Common/CardCaption";
import MainCard from "../Common/MainCard";
import Notify from "../../Notify";



class RegisterView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            isLoading:false,
        }

        this.handleChange = this.handleChange.bind(this);
        this.handleClick = this.handleClick.bind(this);
        this.handleStatus = this.handleStatus.bind(this);
    }

    handleChange(inputData, inputName){
        this.setState({[inputName] : inputData});
    }

    handleStatus(data){
        console.log(data.status);
        if(data.status === 201){
            toast.success(<Notify text="Успешная регистрация"/>, {autoClose : 1000 });
            this.setState({isLoading: false, isLoaded: true});
            this.props.willAuth(true);
            const appProvider = this.props.appProvider;
            appProvider.saveAuth(data.token, data.user);
        }else{
            this.setState({isLoading: false});
            toast.error(<Notify text="Ошибка регистрации"/>, {autoClose : 1000 });
        }
    }

    handleClick(){
        this.setState({isLoading: true});
        const authProvider = new AuthProvider();
        authProvider.register(this.state, this.handleStatus);
    }

    render() {
        return (
            <>
                <LogoComponent/>
                <MainCard>
                    <CardCaption caption="Регистрация"/>
                    <div className="flex flex-row justify-center">
                        <div className="mx-2">
                            <InputComponent placeholder="Введите фамилию" type="text" name="last_name" handle={this.handleChange}/>
                            <InputComponent placeholder="Введите имя" type="text" name="first_name" handle={this.handleChange}/>
                            <InputComponent placeholder="Введите отчество" type="text" name="patronymic" handle={this.handleChange}/>
                            <InputComponent placeholder="Введите номер" type="text" name="phone" handle={this.handleChange}/>
                        </div>
                        <div className="mx-2">
                            <InputComponent placeholder="Введите почту" type="text" name="email" handle={this.handleChange}/>
                            <InputComponent placeholder="Придумайте логин" type="text" name="login" handle={this.handleChange}/>
                            <InputComponent placeholder="Придумайте пароль" type="password" name="password"
                                            handle={this.handleChange}/>
                            <InputComponent placeholder="Повторите пароль пароль" type="password" name="password_confirmation"
                                            handle={this.handleChange}/>
                        </div>
                    </div>


                    <SubmitForm isLoading={this.state.isLoading} action={this.handleClick} value="Зарегестрироваться" isRemember={false}/>
                </MainCard>
                <SwapWindow caption="Если есть у вас есть аккаунт можете пройти " data="авторизацию" link="/"/>
            </>
        );
    }
}

export default RegisterView;
