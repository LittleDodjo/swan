import React, {Component} from 'react';
import Step from "./Components/Step";
import Mail from "./Components/Resources/Mail";
import Account from "./Components/Resources/Account";
import CloseRegister from "./Components/CloseRegister";
import MailForm from "./RegisterForms/MailForm";
import UserForm from "./RegisterForms/UserForm";

class RegisterView extends Component {

    constructor(props) {
        super(props);

        this.state = {
            step: 0,
        }

        this.handleStep = this.handleStep.bind(this);
        this.employee = this.employee.bind(this);
    }

    handleStep(step, data) {
        this.setState({step: step});
        this.setState({[data[0]]: data[1]});
    }

    employee() {
        return this.state.employee_id;
    }

    render() {
        const steps = [
            {
                caption: "Электронная почта",
                svg: <Mail/>,
                body: <MailForm id={0} action={this.handleStep}/>
            },
            {
                caption: "Учетная запись",
                svg: <Account/>,
                body: <UserForm id={1} employee={this.employee} action={this.props.action}/>
            },
        ];
        return (
            <div className="register-window">
                <div className="flex h-full w-full flex-col">
                    <div className="my-auto p-5 h-full">
                        <div className="text-center flex justify-center">
                            <h1 className="px-6 w-fit text-5xl text-white">Регистрация</h1>
                            <CloseRegister action={this.props.action}/>
                        </div>
                        <div className="mx-4 p-4 my-10">
                            <div className="flex items-center">
                                {steps.map((data, key) =>
                                    <Step key={key.toString()} svg={data.svg} caption={data.caption}
                                          end={key === (steps.length - 1)} id={key} employee={this.employee}
                                          step={this.state.step}
                                    />
                                )}
                            </div>
                        </div>
                        <div className="flex flex-col items-center justify-center">
                            {steps[this.state.step].body}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default RegisterView;


