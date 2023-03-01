import React, {Component} from 'react';
import SplashScreen from "../../../Common/Components/SplashScreen";
import Plus24 from "../../../Common/Resources/Plus24";
import StampProvider from "../../../Providers/StampProvider";
import toast from "react-hot-toast";
import CookieProvider from "../../../Providers/CookieProvider";

class StampCreate extends Component {

    constructor(props) {
        super(props);
        this.state = {
            value: 1,
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange(e) {
        this.setState({value: e.target.value});
    }

    handleSubmit(e) {
        StampProvider.store(this.state, (response) => {
            if (response.status === 200) {
                CookieProvider.removeSession('stampsRegister');
                StampProvider.stamps();
                toast.success('Номинал успешно добавлен!');
            } else {
                toast.error(response.message);
            }
        });
    }

    render() {
        return (
            <SplashScreen state={this.props.state} action={this.props.action} caption="Добавить номинал">
                <div className="flex flex-col shadow-lg border-b">
                    <div className="flex border-b">
                        <p className="p-2 font-light text-xl w-full border-r">Введите номинал марки</p>
                        <input type="number" placeholder="Не менее 00.01 и не более 99.99"
                               className="w-full border-none focus:ring-0" value={this.state.value}
                               onChange={this.handleChange} min="0.01" max="99.99"/>
                    </div>
                    <div className="flex hover:fill-indigo-500 hover:bg-slate-100 justify-center p-4 cursor-pointer"
                         onClick={this.handleSubmit}>
                        <Plus24/>
                        <p>Добавить номинал</p>
                    </div>
                </div>
            </SplashScreen>
        );
    }
}

export default StampCreate;
