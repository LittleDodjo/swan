import React, {Component} from 'react';
import DepartureEmail from "./DepartureEmail";
import DeparturePeople from "./DeparturePeople";

class DepartureBlock extends Component {

    constructor(props) {
        super(props);
        this.state = {
            organization: null,
            departureType: "mail",
            date: "",
            name: "",
            address: "",
        };

        this.handleType = this.handleType.bind(this);
        this.handleDate = this.handleDate.bind(this);
        this.handleChange = this.handleChange.bind(this);
    }

    handleType(event) {
        this.setState({departureType: event.target.value});
        this.props.action({departureType: event.target.value});
    }

    handleDate(event) {
        this.setState({date: event.target.value});
        this.props.action({date: event.target.value});

    }

    handleChange(event) {
        this.setState({...event});
        this.props.action({...event});

    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        if (prevProps.organization !== this.props.organization) {
            this.setState({organization: this.props.organization});
            this.forceUpdate()
        }
    }

    componentDidMount() {
        const date = new Date();
        this.setState({date: date.toISOString().split('T')[0]});
        this.props.action({date: date.toISOString().split('T')[0]});
    }

    render() {
        return (
            <>
                <div className="flex">
                    <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Выберете адресата</p>
                    <select
                        className="basis-4/6 min-h-full border-none focus:ring-0 uppercase hover:bg-slate-100 hover:text-indigo-500"
                        name="departure_type"
                        value={this.state.departureType}
                        onChange={this.handleType}>
                        <option value="mail">Отправка электронной почтой</option>
                        <option value="organization">Отправка организцации</option>
                        <option value="people">Отправка гражданину</option>
                    </select>
                </div>
                {this.state.departureType === 'people' ?
                    <DeparturePeople action={(e) => this.handleChange(e)}/>
                    :

                    <div className="flex">
                        {this.state.departureType === 'mail' ?
                            <DepartureEmail action={(e) => this.handleChange(e)}/>
                            : ""}
                        {this.state.departureType === 'organization' ?
                            <>
                                <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Выберете
                                    организацию</p>
                                <input type="button"
                                       value={this.state.organization !== null || undefined ? this.state.organization.fullName : "Выбрать"}
                                       onClick={() => this.props.organizationWindow(true)}
                                       className="basis-4/6 hover:text-indigo-500 hover:bg-slate-100"/>
                            </>
                            : ""}
                    </div>
                }
                <div className="flex">
                    <p className="basis-2/6 my-auto text-lg font-light p-4 border-r">Укажите дату отправки</p>
                    <input type="date" name="date" onChange={this.handleDate} value={this.state.date}
                           className="basis-4/6 my-auto h-full border-none focus:ring-0 uppercase"/>
                </div>
            </>
        );
    }

}

export default DepartureBlock;
