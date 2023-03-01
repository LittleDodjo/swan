import React, {Component} from 'react';
import withRouter from "../../../withRouter";
import CookieProvider from "../../../Providers/CookieProvider";
import OutgoingProvider from "../../../Providers/OutgoingProvider";
import toast from "react-hot-toast";
import SplashLoader from "../../../AppLogin/Components/SplashLoader";
import ArrowLeft24 from "../../../Common/Resources/ArrowLeft24";
import ButtonRounded from "../../../Common/Components/ButtonRounded";
import Delete24 from "../../../Common/Resources/Delete24";
import Edit24 from "../../../Common/Resources/Edit24";
import Fails from "../../../Common/Components/Fails";

class OutgoingShow extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loaded: false,
            fails: false,
            data: null,
        };
        this.getSendType = this.getSendType.bind(this);
        this.delete = this.delete.bind(this);
        this.getSendType = this.getSendType.bind(this);
    }

    componentDidMount() {
        if (!CookieProvider.issetSession('outgoing.' + this.props.params.id)) {
            OutgoingProvider.show(this.props.params.id, (res) => {
                if (res.status === 200) {
                    this.setState({loaded: true, data: res.data});
                    CookieProvider.writeSession('outgoing.' + this.props.params.id, res.data);
                } else {
                    this.setState({fails: true, loaded: true});
                    toast.error("Ошибка загрузки (" + res.status + ")");
                }
            })
        } else {
            this.setState({
                loaded: true,
                data: CookieProvider.readSession('outgoing.' + this.props.params.id)
            });
        }

    }

    delete() {
        OutgoingProvider.delete(this.props.params.id, (res) => {
            if (res.status === 200) {
                CookieProvider.removeSession("outgoing");
                this.props.navigate("/app/outgoing");
                toast.success("Докумен удален");
            } else {
                toast.error("Ошибка удаления");
            }
        })
    }


    getSendType(type) {
        switch (type) {
            case 'mail':
                return 'На электронную почту';
            case 'organization':
                return 'В организацию';
            case 'people':
                return 'Гражданину';
            default:
                return 'неизвестно';
        }
    }

    render() {
        if (this.state.fails) return <Fails/>
        return (
            <>
                <div className="flex mx-10 justify-between">
                    <div className="flex">
                        <ArrowLeft24 link="/app/outgoing"/>
                        <h1 className="text-3xl my-4">Просмотр исходящего документа</h1>
                    </div>
                    <div className="flex">
                        <ButtonRounded caption="Изменить документ" svg={<Edit24/>}
                                       action={() => this.props.navigate("/app/outgoing/edit/" + this.props.params.id)}
                                       class="rounded-button-secondary"/>
                        <ButtonRounded caption="Удалить документ" svg={<Delete24/>} action={this.delete}
                                       class="rounded-button-secondary"/>
                    </div>
                </div>
                {this.state.loaded ?
                    <div className="flex flex-col mx-10 body-view">
                        <div
                            className="flex flex-col divide-y bg-white shadow-md border border-gray-400 rounded-xl">
                            <div className="flex cursor-pointer">
                                <h1 className="text-xl  m-4">Письмо {this.state.type ? "заказное, конверт не маркированный" :
                                    "простое, конверт маркированный"}</h1>
                                <p className="outgoing-border-date">от {this.state.data.created} г.</p>
                                <h1 className="text-xl  m-4">На основании документа
                                    №{this.state.data.registrationNumber}</h1>
                                <p className="outgoing-border-date">от {this.state.data.registrationDate} г.</p>
                            </div>

                            <div className="flex flex-col cursor-pointer">
                                <div className="flex flex-col divide-y">
                                    <div className="divide-x flex">
                                        <div className="w-full p-4">Количество листов</div>
                                        <div className="w-full p-4 text-center">{this.state.data.lists} шт.</div>
                                        <div className="w-full p-4">Количество конвертов</div>
                                        <div className="w-full p-4 text-center">{this.state.data.envelopes} шт.</div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div
                            className="flex flex-col divide-y bg-white shadow-md border border-gray-400 rounded-xl">
                            <div className="flex">
                                <h1 className="text-xl m-4">Документ направлен
                                    {/*{this.getSendType(this.state.departure[0])}*/}
                                </h1>
                            </div>
                        </div>

                        <div
                            className="flex flex-col divide-y bg-white shadow-md border border-gray-400 rounded-xl">
                            <div className="flex">
                                <h1 className="text-xl m-4">Использовано марок</h1>
                                <p className="outgoing-border-date">{this.state.data.stamps.total} шт., на
                                    сумму {this.state.data.stamps.price} руб.</p>
                            </div>
                            <div className="flex flex-col divide-y">
                                {Object.entries(this.state.data.stamps).map((value) =>
                                    value[0] !== 'price' && value[0] !== 'total' ?
                                        <div className="divide-x flex" key={value[0]}>
                                            <div className="w-full p-4">Номинал {value[1].value} руб.</div>
                                            <div className="w-full p-4">{value[1].used} шт.</div>
                                        </div>
                                        : null
                                )}
                            </div>
                        </div>

                    </div> :
                    <SplashLoader/>
                }
            </>
        );
    }
}

export default withRouter(OutgoingShow);
