import React, {Component} from 'react';
import {toast} from "react-hot-toast";
import SvgInput from "../../Common/SvgInput";
import Email24 from "../../Common/Resources/Email24";
import BaseButton from "../../Common/BaseButton";
import Loading from "../../Common/Resources/Loading";
import AuthServiceProvider from "../../Providers/AuthServiceProvider";

class MailForm extends Component {

    constructor(props) {
        super(props);
        this.state = {
            email: "soave99@bk.ru",
            loading: false,
        }

        this.handleStep = this.handleStep.bind(this);
        this.handleInput = this.handleInput.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleSubmit() {
        this.setState({loading: true});
        const provider = new AuthServiceProvider();
        provider.employee(this.state.email, this.handleStep);
    }

    handleStep(data) {
        this.setState({loading: false});
        if (data.code === 200) {
            this.props.action(parseInt(this.props.id) + 1, ['employee_id', data.employee_id]);
        }else{
            toast.error(data.message);
        }
    }

    handleInput(e) {
        this.setState({email: e.target.value});
    }

    render() {
        return (
            <>
                <div className="my-auto">
                    <h1 className="text-3xl font-light text-white">Укажите вашу электронную почту</h1>
                </div>
                <div className="flex flex-row w-1/2 my-10 justify-center">
                    <SvgInput data={this.state.email} handleChange={this.handleInput} name="email"
                              svg={<Email24/>}
                              placeholder="Введите логин" type="text"/>
                    <BaseButton action={this.handleSubmit} value="Продолжить" class="mx-4 h-full my-auto"/>
                </div>
                {this.state.loading ? <Loading/> : ""}
            </>
        );
    }
}

export default MailForm;
