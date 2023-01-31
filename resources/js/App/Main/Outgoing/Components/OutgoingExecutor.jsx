import React, {Component} from 'react';
import SplashScreen from "../../../Common/Components/SplashScreen";
import SplashLoader from "../../../AppLogin/Components/SplashLoader";
import EmployeeProvider from "../../../Providers/EmployeeProvider";
import toast from "react-hot-toast";
import EmployeeCard from "../../../Common/Components/EmployeeCard";

class OutgoingExecutor extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loaded: false,
            fails: false,
            employees: [],
        };

    }

    componentDidMount() {
        this.forceUpdate(() => {
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
        });
    }

    render() {
        if (this.state.fails) return <>Ошибка загрузки данных</>
        return (
            <SplashScreen action={this.props.action} state={this.props.state} caption="Выбрать исполнителя">
                {this.state.loaded ?
                    <div className="grid grid-cols-2 h-fit overflow-y-auto">
                        <div className="col-span-2 bg-slate-100 m-4 border-b border-gray-300">
                            <input type="text" placeholder="Найти сотрудника"
                                   className="w-full h-full focus:ring-0 border-none px-2"/>
                        </div>
                        {this.state.employees.map((value, key) => (
                            <EmployeeCard key={key} {...value} action={this.props.select} close={this.props.action}/>
                        ))}
                    </div>
                    : <SplashLoader/>}
            </SplashScreen>
        );
    }
}

export default OutgoingExecutor;
