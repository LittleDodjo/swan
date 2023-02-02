import React, {Component} from 'react';
import SplashScreen from "../../../Common/Components/SplashScreen";
import SplashLoader from "../../../AppLogin/Components/SplashLoader";
import EmployeeProvider from "../../../Providers/EmployeeProvider";
import EmployeeCard from "../../../Common/Components/EmployeeCard";
import toast from "react-hot-toast";

class OutgoingExecutor extends Component {

    constructor(props) {
        super(props);
        this.state = {
            query: "",
            loaded: false,
            fails: false,
            employees: [],
        };

        this.search = this.search.bind(this);
        this.loadData = this.loadData.bind(this);
    }

    search(event) {
        this.setState({query: event.target.value});
    }

    loadData() {
        EmployeeProvider.index((data) => {
            if (data.status === 200) {
                this.setState({loaded: true, employees: data.data});
                return;
            } else {
                toast.error(`Ошибка загрузки данных ${data.status}`);
                this.setState({fails: true});
                return;
            }
        });
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        if(prevProps.state !== this.props.state){
            if(!this.state.loaded){
                this.loadData();
            }
        }
    }

    componentDidMount() {
        if(this.props.state){
            this.loadData();
        }
    }

    render() {
        if (this.state.fails) return <>Ошибка загрузки данных</>
        const Data = this.state.employees;
        const query = this.state.query;
        return (
            <SplashScreen action={this.props.action} state={this.props.state} caption="Выбрать исполнителя">
                {this.state.loaded ?
                    <div className="grid grid-cols-2 h-fit overflow-y-auto pb-28">
                        <div className="col-span-2 bg-slate-100 m-4 border-b border-gray-300">
                            <input type="text" placeholder="Найти сотрудника" onChange={this.search}
                                   value={this.state.query} name="query"
                                   className="w-full h-full focus:ring-0 border-none px-2"/>
                        </div>
                        {Data.filter(card => {
                            if (query === '') {
                                return card;
                            } else if (card.fullName.toLocaleLowerCase().includes(query.toLocaleLowerCase())) {
                                return card;
                            }
                        }).map((value, key) => (
                            <EmployeeCard key={key} {...value} action={this.props.select}
                                          close={this.props.action}/>
                        ))}
                    </div>
                    : <SplashLoader/>}
            </SplashScreen>
        );
    }

}

export default OutgoingExecutor;
