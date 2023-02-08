import React, {Component} from 'react';
import EmployeeProvider from "../../../Providers/EmployeeProvider";
import toast from "react-hot-toast";
import SplashScreen from "../../../Common/Components/SplashScreen";
import EmployeeCard from "../../../Common/Components/EmployeeCard";
import SplashLoader from "../../../AppLogin/Components/SplashLoader";
import Table from "../../../Common/Components/Table";

class ExecutorSplash extends Component {

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
        this.close = this.close.bind(this);
    }

    close() {
        this.props.action('executorWindow');
        this.setState({query: ""});
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
        if (prevProps.state !== this.props.state) {
            if (!this.state.loaded) {
                this.loadData();
            }
            const el = document.getElementById('window');
            if (this.props.state) {
                // el.scroll(0,0);
                el.classList.add('overflow-hidden');

            } else {
                el.classList.remove('overflow-hidden');
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
        const Data = this.state.employees;
        const query = this.state.query;
        return (
            <SplashScreen action={this.close} state={this.props.state} caption="Выбрать исполнителя">
                {this.state.loaded ?
                    <div className="flex flex-col h-fit overflow-y-auto pb-28">
                        <input type="text" placeholder="Найти сотрудника" onChange={this.search}
                               value={this.state.query} name="query"
                               className="w-full h-full focus:ring-0 border-none px-2"/>
                        <Table head={['*', 'ФИО', 'Должность']}>
                            {Data.filter(card => {
                                if (query === '') {
                                    return card;
                                } else if (card.fullName.toLocaleLowerCase().includes(query.toLocaleLowerCase())) {
                                    return card;
                                }
                            }).map((value, key) => (
                                <tr key={key}
                                    onClick={() => this.props.select(value.id, value.fullName, 'executorWindow')}>
                                    <td>{value.id}</td>
                                    <td>{value.fullName}</td>
                                    <td>{value.appointment.name}</td>
                                </tr>
                            ))}
                        </Table>
                    </div>
                    : <SplashLoader/>}
            </SplashScreen>
        );
    }

}

export default ExecutorSplash;
