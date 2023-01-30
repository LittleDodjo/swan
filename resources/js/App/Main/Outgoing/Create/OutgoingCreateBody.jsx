import React, {Component} from 'react';
import OutgoingExecutor from "../Components/OutgoingExecutor";
import OutgoingStamps from "../Components/OutgoingStamps";

class OutgoingCreateBody extends Component {

    constructor(props) {
        super(props);
        this.state = {
            envelopes_count: 1,
            lists_count: 1,
            message_type: 1,
            registration_number: "",
            registration_date: null,
            departure_data: [],
            stamps_used: [],
            executor_id: null,
            executorWindow: false,
            stampWindow: false,
        }

        this.handleChange = this.handleChange.bind(this);
        this.stampWindow = this.stampWindow.bind(this);
        this.executorWindow = this.executorWindow.bind(this);
    }

    select(key, value){

    }

    executorWindow(state) {
        this.setState({executorWindow: state});
    }

    stampWindow(state) {
        this.setState({executorWindow: state});
    }

    handleChange(event) {
        this.setState({[event.target.name]: event.target.value});
        this.props.action(this.props.id, event.target.name, event.target.value);
    }

    render() {
        return (
            <>
                <OutgoingExecutor  state={this.state.executorWindow} action={(e) => {
                    this.setState({executorWindow: e})
                }}/>
                <OutgoingStamps state={this.state.stampWindow} action={(e) => {
                    this.setState({stampWindow: e})
                }}/>
                <div className="bg-white flex flex-col border-y border-gray-300 mt-4 shadow-lg relative flex overflow-y-auto overflow-x-hidden">
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
                            <input type="button" value="Выбрать" onClick={() => this.executorWindow(true)}
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
                {this.props.id < 9 ?
                    <div className="my-20 text-xl text-indigo-500 flex fill-slate-500 align-text-middle">
                        <svg className="mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                             height="24">
                            <path fill="none" d="M0 0h24v24H0z"/>
                            <path
                                d="M13 16.172l5.364-5.364 1.414 1.414L12 20l-7.778-7.778 1.414-1.414L11 16.172V4h2v12.172z"/>
                        </svg>
                        <p className="cursor-pointer my-auto text-center font-light mx-auto">Продолжайте заполнять</p>
                        <svg className="mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                             height="24">
                            <path fill="none" d="M0 0h24v24H0z"/>
                            <path
                                d="M13 16.172l5.364-5.364 1.414 1.414L12 20l-7.778-7.778 1.414-1.414L11 16.172V4h2v12.172z"/>
                        </svg>
                    </div> :
                    <div className="my-20 text-xl text-indigo-500 flex fill-slate-500 align-text-middle">
                        <p className="cursor-pointer my-auto text-center font-light mx-auto">Документы можно
                            схоранить</p>
                    </div>
                }
            </>
        );
    }
}

export default OutgoingCreateBody;
