import React, {Component} from 'react';
import ButtonRounded from "../../../Common/Components/ButtonRounded";
import Plus24 from "../../../Common/Resources/Plus24";
import StampProvider from "../../../Providers/StampProvider";
import StampsList from "../Components/StampsList";

class OutgoingStore extends Component {

    constructor(props) {
        super(props);
        this.state = {
            stampWindow: false,
            organizationWindow: false,
            executorWindow: false,
            recomended: false,
            messageWeight: "",
            message_type: 0,
            stamps_used: [],
        }

        this.splashWindow = this.splashWindow.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleWeight = this.handleWeight.bind(this);
        this.handleType = this.handleType.bind(this);
    }

    splashWindow(key, value = true) {
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

    render() {
        return (
            <div className="flex flex-col">
                <div className="flex justify-between">
                    <h1 className="text-3xl m-4">Создание исходящего документа</h1>
                    <ButtonRounded caption="Создать документ" svg={<Plus24/>}/>
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
                        <input type="text" className="rounded-lg w-full" placeholder="Номер регистрации"/>
                    </div>
                    <div className="flex pb-4 mb-4 border-b">
                        <p className="text-lg my-auto basis-2/6">Укажите дату регистрации</p>
                        <input type="date" className="rounded-lg w-full"/>
                    </div>
                    <div className="flex pb-4 border-b mb-4">
                        <p className="text-lg my-auto basis-2/6">Выберете исполнителя</p>
                        <p className="select-button">
                            Выбрать</p>
                    </div>
                    <div className="flex pb-4 mb-4">
                        <p className="text-lg my-auto basis-2/6">Выберете тип отправления</p>
                        <select name="departure_type" className="w-full rounded-lg">
                            <option value="organization">В организацию</option>
                            <option value="email">На электронную почту</option>
                            <option value="people">Гражданину</option>
                        </select>
                    </div>
                    <div className="flex pb-4 border-b mb-4">
                        <p className="text-lg my-auto basis-2/6">Выберете организацию</p>
                        <p className="select-button">
                            Выбрать</p>
                    </div>
                    <div className="flex pb-4 mb-4">
                        <p className="text-lg my-auto basis-2/6">Укажите дату отправки</p>
                        <input type="date" className="rounded-lg w-full"/>
                    </div>
                    <div className="flex pb-4 mb-4">
                        <p className="text-lg my-auto basis-2/6">Добавьте необходимые марки</p>
                        <ButtonRounded caption="Добавить" svg={<Plus24/>} class={'rounded-button-secondary'}/>
                    </div>

                    <StampsList stamps={this.state.stamps_used}
                                action={(stamps) => this.setState({stamps_used: stamps, recomended: false})}
                                recomended={this.state.recomended}/>
                </div>
            </div>
        );
    }
}

export default OutgoingStore;
