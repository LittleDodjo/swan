import React, {Component} from 'react';
import SplashScreen from "../../../Common/Components/SplashScreen";
import StampProvider from "../../../Providers/StampProvider";
import toast from "react-hot-toast";
import InputNumber from "./InputNumber";
import SplashLoader from "../../../AppLogin/Components/SplashLoader";
import Plus24 from "../../../Common/Resources/Plus24";
import CookieProvider from "../../../Providers/CookieProvider";
import ButtonRounded from "../../../Common/Components/ButtonRounded";

class AssignBalance extends Component {


    constructor(props) {
        super(props);
        this.state = {
            loaded: false,
            fails: false,
            balance: [],
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange(id, value) {
        const obj = this.state.balance.find((object) => {
            if (object.id.toString() === id.toString()) return object;
        });
        obj.assign = value;
    }

    handleSubmit() {
        const stamps = {balance: []};
        this.state.balance.map((value) => {
            if (value.assign > 0) {
                stamps.balance.push({
                    id: value.id,
                    count: value.assign,
                });
            }
        });
        this.setState({loaded: false});
        StampProvider.balance(stamps, (response) => {
            this.setState({loaded: true});
            if (response.status === 200) {
                toast.success('Марки успешно начислены на баланс');
                this.props.action(false);
                this.setState({loaded: false});
                CookieProvider.removeSession('stampsRegister');
                StampProvider.stamps();
            } else {
                toast.error(`При сохранении возникла ошибка (${response.status})`);
            }
        });
    }

    loadData() {
        StampProvider.index((data) => {
            if (data.status === 200) {
                const stamps = data.data;
                stamps.map((stamp) => stamp.assign = "");
                this.setState({loaded: true, balance: stamps});
                return;
            } else {
                toast.error(`Ошибка загрузки данных ${data.status}`);
                this.setState({fails: true});
                return;
            }
        });
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        if (prevProps.state !== this.props.state) {
            const el = document.getElementById('ref');
            if (this.props.state) {
                el.classList.add('overflow-y-hidden');
            } else {

                el.classList.remove('overflow-y-hidden');
            }
            if (!this.state.loaded) {
                this.loadData();
            }
        }
    }

    componentDidMount() {
        if (this.props.state) {
            this.loadData();
        }
    }

    render() {
        return (
            <SplashScreen state={this.props.state} action={this.props.action}
                          caption="Создание поступления марок на баланс">
                {this.state.loaded ?
                    <div className="h-full overflow-y-scroll pb-28">
                        <div className="flex justify-between mx-4">
                            <h1 className="text-xl my-4">Доступные номиналы марок</h1>
                            <ButtonRounded caption="Начислить на балланс" svg={<Plus24/>} action={this.handleSubmit}/>
                        </div>
                        <div className="flex flex-col divide-y border-b text-center border mx-4 rounded-xl shadow-md">
                            <div className="flex divide-x bg-gray-50">
                                <p className="p-4 font-light text-lg w-full">Номинал марки</p>
                                <p className="p-4 font-light text-lg w-full">Текущий балланс</p>
                                <p className="p-4 font-light text-lg w-full">Добавить</p>
                            </div>
                            {this.state.balance.map((value, key) => (
                                <div className="flex divide-x bg-white" key={key}>
                                    <p className="p-4 font-light text-lg w-full">Марка {value.value} руб.</p>
                                    <p className="p-4 font-light text-lg w-full">{value.count} шт.</p>
                                    <p className="p-4 w-full min-h-full">
                                        <InputNumber id={value.id} action={this.handleChange}/>
                                    </p>

                                </div>
                            ))}
                        </div>
                    </div>
                    : <SplashLoader/>}
            </SplashScreen>

        );
    }

}

export default AssignBalance;
