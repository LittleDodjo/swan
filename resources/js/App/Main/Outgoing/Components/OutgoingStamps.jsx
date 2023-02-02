import React, {Component} from 'react';
import SplashScreen from "../../../Common/Components/SplashScreen";
import toast from "react-hot-toast";
import StampProvider from "../../../Providers/StampProvider";

class OutgoingStamps extends Component {

    constructor(props) {
        super(props);
        this.state = {
            query: "",
            loaded: false,
            fails: false,
            stamps: [],
        };

        this.search = this.search.bind(this);
        this.loadData = this.loadData.bind(this);
    }

    search(event) {
        this.setState({query: event.target.value});
    }

    loadData() {
        StampProvider.index((data) => {
            if (data.status === 200) {
                this.setState({loaded: true, stamps: data.data});
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
        if (this.state.fails) return <>Ошибка загрузки данных</>
        const Data = this.state.stamps;
        const query = this.state.query;
        const filter = this.props.filter.map(v => v.id);
        return (
            <SplashScreen state={this.props.state} action={this.props.action} caption="Реестр марок">
                <div className="grid grid-cols-4 h-fit overflow-y-auto pb-28">
                    <div className="col-span-4 bg-slate-100 m-4 border-b border-gray-300">
                        <input type="text" placeholder="Найти номинал марки" onChange={this.search}
                               value={this.state.query} name="query"
                               className="w-full h-full focus:ring-0 border-none px-2"/>
                    </div>
                    {Data.filter(card => {
                        if (!filter.includes(card.id)) {
                            if (query === '') {
                                return card;
                            } else if (card.value.toLocaleLowerCase().includes(query.toLocaleLowerCase())) {
                                return card;
                            }
                        }
                    }).map((value, key) => (
                        <div onClick={() => {
                            this.props.select(value.id);
                            this.props.action(false);
                        }} key={key}
                             className="border hover:bg-gray-100 shadow-lg hover:border-indigo-500 transition-colors delay-75 hover:text-indigo-500 cursor-pointer rounded-xl m-4 p-4 flex flex-col">
                            <p className="border-b border-gray-300">Почтовая марка</p>
                            <div className="flex my-2">
                                <p className="w-full text-xl my-auto">{value.value} руб.</p>
                                <p className="font-bold my-auto basis-4/6">{value.count} шт.</p>
                            </div>
                        </div>
                    ))}
                </div>
            </SplashScreen>
        );
    }
}

export default OutgoingStamps;
