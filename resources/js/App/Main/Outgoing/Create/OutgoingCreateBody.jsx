import React, {Component} from 'react';
import OutgoingExecutor from "../Components/OutgoingExecutor";
import OutgoingStamps from "../Components/OutgoingStamps";
import EmployeeProvider from "../../../Providers/EmployeeProvider";
import toast from "react-hot-toast";

class OutgoingCreateBody extends Component {

    constructor(props) {
        super(props);
        this.state = {
            employee: "",
            envelopes_count: 1,
            lists_count: 1,
            message_type: 1,
            registration_number: "",
            registration_date: null,
            departure_data: [],
            stamps_used: [],
            executor_id: null,
            executorWindow: true,
            stampWindow: false,
        }

        this.handleChange = this.handleChange.bind(this);
        this.handleSelect = this.handleSelect.bind(this);
        this.stampWindow = this.stampWindow.bind(this);
        this.executorWindow = this.executorWindow.bind(this);
    }

    select(key, value) {

    }

    executorWindow(state) {
        this.setState({executorWindow: state});
    }

    stampWindow(state) {
        this.setState({executorWindow: state});
    }

    handleChange(event) {
        this.setState({[event.target.name]: event.target.value});
        this.props.action(event.target.name, event.target.value);
    }

    handleSelect(field, id)
    {
        this.props.action(field, id);
    }


    componentDidUpdate(prevProps, prevState, snapshot) {
        if (prevState.fullName !== this.state.fullName) {
            this.forceUpdate();
        }
    }

    render() {
        return (
            <>
                <div className="bg-white flex flex-col border-y border-gray-300 mt-4 shadow-lg overflow-hidden">
                    <div className="flex">
                        <h1 className="text-xl p-4 border-r w-full">Исходящий документ #{this.props.id}</h1>
                        <select className="create-outgoing-select" value={this.state.select}
                                onChange={this.handleChange} name="message_type">
                            <option value={0}>Письмо простое, конверт не маркированный</option>
                            <option value={1}>Письмо заказное, конверт маркированный</option>
                        </select>
                    </div>
                    <div className="divide-y border-t border-gray-300">
                        <div className="flex">
                            <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Укажите номер
                                регистрации</p>
                            <input type="text" name="registration_number" onChange={this.handleChange}
                                   value={this.state.registration_number}
                                   className="basis-4/6 my-auto h-full border-none focus:ring-0 uppercase"
                                   placeholder="Введите номер"/>
                        </div>
                        <div className="flex">
                            <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Укажите дату
                                регистрации</p>
                            <input type="date" name="registration_date" onChange={this.handleChange}
                                   className="basis-4/6 my-auto h-full border-none focus:ring-0 uppercase"/>
                        </div>
                        <div className="flex">
                            <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Выберете исполнителя</p>
                            <input type="button" value={this.state.fullName !== null ? this.state.fullName : "Выбрать"}
                                   onClick={() => this.executorWindow(true)}
                                   className="basis-4/6 hover:text-indigo-500 hover:bg-slate-100"/>
                        </div>
                        <div className="flex">
                            <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Выберете адресата</p>
                            <select
                                className="basis-4/6 h-full border-none focus:ring-0 uppercase hover:bg-slate-100 hover:text-indigo-500 "
                                value={this.state.select}
                                onChange={this.handleChange}>
                                <option value={0}>Отправка электронной почтой</option>
                                <option value={1}>Отправка организцации</option>
                                <option value={1}>Отправка гражданину</option>
                            </select>
                        </div>
                        <div className="flex">
                            <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Укажите вес письма</p>
                        </div>
                        <div className="flex flex-col">
                            <div className="flex border-b">
                                <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Выберете
                                    необходимые
                                    марки</p>
                                <input type="button" value="Добавить марку"
                                       className="basis-4/6 hover:text-indigo-500 hover:bg-slate-100"/>
                            </div>
                            <div
                                className="m-4 p-4 rounded-lg border border-gray-300 bg-gray-100 flex flex-wrap">test
                            </div>
                        </div>
                    </div>
                </div>
                <OutgoingExecutor state={this.state.executorWindow} action={(e) => {
                    this.setState({executorWindow: e})
                }} select={(id) => {
                    this.setState({executor_id: id});
                    EmployeeProvider.employee(id, (response) => {
                        console.log(response);
                        if (response.status === 404) {
                            toast.error("Такой пользователь не найден");
                            this.setState({fullName: "404"});
                        }
                        if (response.status === 200) {
                            this.setState({fullName: response.employee.full_name});
                            this.handleSelect('executor_id', id);
                        }
                    });
                }}/>
                <OutgoingStamps state={this.state.stampWindow} action={(e) => {
                    this.setState({stampWindow: e})
                }}/>
            </>
        );
    }
}

export default OutgoingCreateBody;
