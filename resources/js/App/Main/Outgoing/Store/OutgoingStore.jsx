import React, {Component} from 'react';
import ButtonRounded from "../../../Common/Components/ButtonRounded";
import Plus24 from "../../../Common/Resources/Plus24";
import StampProvider from "../../../Providers/StampProvider";
import StampsList from "./StampsList";
import ExecutorSplash from "./ExecutorSplash";
import OrganizationSplash from "./OrganizationSplash";
import StampsSplash from "./StampsSplash";
import OutgoingProvider from "../../../Providers/OutgoingProvider";
import toast from "react-hot-toast";

class OutgoingStore extends Component {

    constructor(props) {
        super(props);
        this.state = {
            fullName: "",
            departureFullName: "",
            stampWindow: false,
            organizationWindow: false,
            executorWindow: false,
            recomended: false,
            messageWeight: "",
            message_type: 0,
            registration_number: "",
            registration_date: "",
            departure_type: 'organization',
            departure_date: "",
            departure_address: "",
            departure_name: "",
            stamps_used: [],
        }

        this.store = this.store.bind(this);
        this.splashWindow = this.splashWindow.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleWeight = this.handleWeight.bind(this);
        this.handleType = this.handleType.bind(this);
        this.handleExecutor = this.handleExecutor.bind(this);
        this.handleOrganization = this.handleOrganization.bind(this);
        this.handleStamp = this.handleStamp.bind(this);
    }

    store(){
        OutgoingProvider.store(this.state, (res) => {
            if(res.status === 200){
                this.props.navigate("/app/outgoing");
            }else{
                toast.error("Ошибка сохранения");
            }
        });
    }

    splashWindow(key, value = false) {
        this.setState({[key]: value});
    }

    handleWeight(event) {
        this.setState({[event.target.name]: event.target.value, recomended: true});
        const stamps = StampProvider.getStamps(StampProvider.getPrice(this.state.message_type, event.target.value));
        if (stamps !== false) {
            this.setState({stamps_used: stamps});
        } else {
            this.setState({stamps_used: [], recomended: false});
        }
    }

    handleType(event) {
        this.setState({[event.target.name]: event.target.value, recomended: true});
        const stamps = StampProvider.getStamps(StampProvider.getPrice(event.target.value, this.state.messageWeight));
        if (stamps !== false) {
            this.setState({stamps_used: stamps});
        } else {
            this.setState({stamps_used: [], recomended: false});
        }
    }

    handleChange(event) {
        this.setState({[event.target.name]: event.target.value});
    }

    handleExecutor(id, fullName) {
        this.setState({executor_id: id, fullName: fullName, executorWindow: false});
    }

    handleOrganization(id, fullName) {
        this.setState({departure_address: id, departureFullName: fullName, organizationWindow: false});
    }

    handleStamp(stamp) {
        const stamps = this.state.stamps_used;
        stamps.push({
            id: stamp.id,
            value: stamp.value,
            count: 1,
            max: stamp.count,
        });
        this.setState({stamps_used: stamps});
    }

    componentDidMount() {
        const date = new Date();
        this.setState({departure_date: date.toISOString().split('T')[0]});
    }

    render() {
        return (
            <div className="body-view " id="window">
                <div className="flex justify-between w-5/6 mx-auto">
                    <h1 className="text-3xl my-4">Создание исходящего документа</h1>
                    <ButtonRounded caption="Создать документ" svg={<Plus24/>} action={this.store}/>
                </div>
                <div className="back-card">
                    <div className="flex border-b pb-4 mb-4">
                        <p className="text-lg my-auto basis-2/6">Укажите тип письма</p>
                        <div className="flex w-full">
                            <select name="message_type" className="mr-2 rounded-lg basis-1/4"
                                    value={this.state.message_type} onChange={this.handleType}>
                                <option value={1}>Простое</option>
                                <option value={0}>Заказное</option>
                            </select>
                            <input type="number" placeholder="Введите вес письма в граммах"
                                   className="rounded-lg w-full" name="messageWeight" onChange={this.handleWeight}
                                   value={this.state.messageWeight}
                            />
                        </div>
                    </div>
                    <div className="flex pb-4">
                        <p className="text-lg my-auto basis-2/6">Укажите номер регистрации</p>
                        <input type="text" className="rounded-lg w-full" placeholder="Номер регистрации"
                               onChange={this.handleChange}
                               name="registration_number" value={this.state.registration_number}/>
                    </div>
                    <div className="flex pb-4 mb-4 border-b">
                        <p className="text-lg my-auto basis-2/6">Укажите дату регистрации</p>
                        <input type="date" className="rounded-lg w-full" name="registration_date"
                               value={this.state.registration_date} onChange={this.handleChange}/>
                    </div>
                    <div className="flex pb-4 border-b mb-4">
                        <p className="text-lg my-auto basis-2/6">Выберете исполнителя</p>
                        <p className="select-button"
                           onClick={() => this.splashWindow('executorWindow', true)}>
                            {this.state.fullName === "" ? "Выбрать" : this.state.fullName}
                        </p>
                    </div>
                    <div className="flex pb-4 mb-4">
                        <p className="text-lg my-auto basis-2/6">Выберете тип отправления</p>
                        <select name="departure_type" className="w-full rounded-lg" onChange={(e) => {
                            this.handleChange(e);
                            this.setState({departureFullName: "", departure_address: "", departure_name: ""});
                        }}
                                value={this.state.departure_type}>
                            <option value="organization">В организацию</option>
                            <option value="mail">На электронную почту</option>
                            <option value="people">Гражданину</option>
                        </select>
                    </div>
                    {this.state.departure_type === "organization" ?
                        <div className="flex pb-4 mb-4">
                            <p className="text-lg my-auto basis-2/6">Выберете организацию</p>
                            <p className="select-button" onClick={() => this.splashWindow('organizationWindow', true)}>
                                {this.state.departureFullName === "" ? "Выбрать" : this.state.departureFullName}</p>
                        </div>
                        : ""}

                    {this.state.departure_type === "people" ?
                        <>
                            <div className="flex pb-4 mb-4">
                                <p className="text-lg my-auto basis-2/6">Укажите адрес получателя</p>
                                <input type="text" className="rounded-lg w-full" placeholder="Введите адрес получателя"
                                       onChange={this.handleChange}
                                       name="departure_address" value={this.state.departure_address}/>
                            </div>
                            <div className="flex pb-4 border-b mb-4">
                                <p className="text-lg my-auto basis-2/6">Укажите ФИО получателя</p>
                                <input type="text" className="rounded-lg w-full" placeholder="Укажите ФИО получателя"
                                       onChange={this.handleChange}
                                       name="departure_name" value={this.state.departure_name}/>
                            </div>
                        </>
                        : ""}
                    {this.state.departure_type === "mail" ?
                        <div className="flex pb-4 mb-4">
                            <p className="text-lg my-auto basis-2/6">Укажите электронную почту</p>
                            <input type="text" className="rounded-lg w-full"
                                   placeholder="Укажите адрес электронной почты"
                                   onChange={this.handleChange}
                                   name="departure_address" value={this.state.departure_address}/>
                        </div>
                        : ""}

                    <div className="flex pb-4 border-b mb-4">
                        <p className="text-lg my-auto basis-2/6">Укажите дату отправки</p>
                        <input type="date" className="rounded-lg w-full" name="departure_date"
                               onChange={this.handleChange}
                               value={this.state.departure_date}/>
                    </div>
                    <div className="flex pb-4 mb-4">
                        <p className="text-lg my-auto basis-2/6">Добавьте необходимые марки</p>
                        <ButtonRounded caption="Добавить" svg={<Plus24/>} class={'rounded-button-secondary'}
                                       action={() => this.splashWindow('stampWindow', true)}
                        />
                    </div>
                    <StampsList stamps={this.state.stamps_used} recomended={this.state.recomended}
                                price={StampProvider.getPrice(this.state.message_type, this.state.messageWeight)}
                                action={(stamps) => this.setState({stamps_used: stamps, recomended: false})}/>
                </div>
                <ExecutorSplash state={this.state.executorWindow} action={this.splashWindow}
                                select={this.handleExecutor}/>
                <OrganizationSplash state={this.state.organizationWindow} action={this.splashWindow}
                                    select={this.handleOrganization}
                />
                <StampsSplash state={this.state.stampWindow} action={this.splashWindow} select={this.handleStamp}
                              filter={this.state.stamps_used}/>
            </div>
        );
    }
}

export default withRouter(OutgoingStore);
