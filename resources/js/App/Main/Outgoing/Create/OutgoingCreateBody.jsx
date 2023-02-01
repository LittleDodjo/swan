import React, {Component} from 'react';
import OutgoingExecutor from "../Components/OutgoingExecutor";
import OutgoingStamps from "../Components/OutgoingStamps";
import EmployeeProvider from "../../../Providers/EmployeeProvider";
import toast from "react-hot-toast";
import DepartureBlock from "./DepartureBlock";
import OutgoingOrganization from "../Components/OutgoingOrganization";
import OrganizationProvider from "../../../Providers/OrganizationProvider";
import StampsList from "./StampsList";
import StampProvider from "../../../Providers/StampProvider";

class OutgoingCreateBody extends Component {

    constructor(props) {
        super(props);
        const date = new Date();
        this.state = {
            address: "",
            name: "",
            date: date.toISOString().split('T')[0],
            departureType: 'organization',
            organization: null,
            departure_type: "email",
            fullName: null,
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
            organizationWindow: false,
            recomended: false,
        }

        this.handleChange = this.handleChange.bind(this);
        this.handleSelect = this.handleSelect.bind(this);
        this.handleDeparture = this.handleDeparture.bind(this);
        this.updateStamps = this.updateStamps.bind(this);
        this.stampWindow = this.stampWindow.bind(this);
        this.executorWindow = this.executorWindow.bind(this);
        this.organizationWindow = this.organizationWindow.bind(this);
    }

    executorWindow(state) {
        this.setState({executorWindow: state});
    }

    stampWindow(state) {
        this.setState({stampWindow: state});
    }

    organizationWindow(state) {
        this.setState({organizationWindow: state});
    }

    handleChange(event) {
        this.setState({[event.target.name]: event.target.value});
        this.props.action(event.target.name, event.target.value);
    }

    handleSelect(field, id) {
        this.props.action(field, id);
    }

    handleDeparture(data) {
        this.setState({...data});
        const type = this.state.departureType;
        const depData = {};
        depData[type] = {
            date: this.state.date,
        };
        if (type === 'organization') {
            if (this.state.organization !== null) {
                depData[type].address = this.state.organization.id;
            }
        }
        if (type === 'people') {
            depData[type] = {
                name: this.state.name,
                address: this.state.address,
                date: this.state.date,
            };
        }
        if (type === 'email') {
            depData[type].address = this.state.address;
        }
        this.props.action('departure_data', depData);
        console.log(depData);
    }

    updateStamps(stamps) {
        this.setState({stamps_used: stamps});
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        if (prevState.fullName !== this.state.fullName) {
            this.forceUpdate();
        }
    }

    render() {
        return (
            <>
                <div
                    className="bg-white flex flex-col border border-gray-300 my-4 shadow-xl  rounded-lg shadow-md mx-10">
                    <div className="flex">
                        <h1 className="text-xl p-4 border-r w-full">Новый исхоящий документ</h1>
                        <select className="create-outgoing-select" value={this.state.select}
                                onChange={this.handleChange} name="message_type">
                            <option value="false">Письмо простое, конверт маркированный</option>
                            <option value="true">Письмо заказное, конверт не маркированный</option>
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
                        <DepartureBlock organization={this.state.organization}
                                        action={(data) => this.handleDeparture(data)}
                                        organizationWindow={this.organizationWindow}/>
                        {/*<StampsWeight action={this.prepareStamps} type={this.state.message_type}/>*/}
                        <div className="flex flex-col">
                            <div className="flex border-b">
                                <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Выберете
                                    необходимые
                                    марки</p>
                                <input type="button" value="Добавить марку" onClick={() => this.stampWindow(true)}
                                       className="basis-4/6 hover:text-indigo-500 hover:bg-slate-100"/>
                            </div>
                            <StampsList stamps={this.state.stamps_used} action={this.updateStamps}/>
                        </div>
                    </div>
                </div>
                <OutgoingExecutor state={this.state.executorWindow} action={this.executorWindow} select={(id) => {
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
                <OutgoingOrganization state={this.state.organizationWindow} action={this.organizationWindow}
                                      select={(id) => {
                                          OrganizationProvider.show(id, (response) => {
                                              if (response.status === 404) {
                                                  toast.error("Организация не найдена");
                                                  this.setState({fullName: "404"});
                                              }
                                              if (response.status === 200) {
                                                  this.setState({organization: response.data});
                                                  const type = this.state.departureType;
                                                  const depData = {};
                                                  depData[type] = {
                                                      date: this.state.date,
                                                  };
                                                  if (type === 'organization') {
                                                      if (this.state.organization !== null) {
                                                          depData[type].address = this.state.organization.id;
                                                      }
                                                  }
                                                  this.props.action('departure_data', depData);
                                              }
                                          });
                                          // this.setState({organization: ""});
                                      }}/>
                <OutgoingStamps state={this.state.stampWindow} action={this.stampWindow} select={(id) => {
                    StampProvider.show(id, (response) => {
                        if (response.status === 404) {
                            toast.error("Марка  не найдена");
                            this.setState({fullName: "404"});
                        }
                        if (response.status === 200) {
                            if (response.data.count === 0) {
                                toast.error("Недостаточно марок на баллансе!");
                                return;
                            }
                            const stamps = this.state.stamps_used;
                            stamps.push({
                                id: response.data.id,
                                value: response.data.value,
                                count: 1,
                                max: response.data.count,
                            });
                            this.setState({stamps_used: stamps});
                            this.props.action('stamps_used', stamps);
                        }
                    });
                }} filter={this.state.stamps_used}/>
            </>
        );
    }
}

export default OutgoingCreateBody;
