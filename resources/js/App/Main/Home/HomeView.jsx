import React, {Component} from 'react';
import EmployeeProvider from "../../Providers/EmployeeProvider";

class HomeView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            employee: null,
            roles: null,
            user: null,
        };
    }

    componentDidMount() {
        this.setState({employee: JSON.parse(sessionStorage.getItem("employee"))});
        this.setState({roles: JSON.parse(sessionStorage.getItem("roles"))});
        this.setState({user: JSON.parse(sessionStorage.getItem("user"))});
    }

    render() {
        if (this.state.employee === null) return (<>loading..</>);
        const employee = this.state.employee;
        return (
            <>
                <div className="bg-white p-4 border-b">
                    <p className="font-light text-xl">Добрый день, {employee.first_name}</p>
                </div>
                <div className="bg-white border-y p-4 mt-4">
                    Пока новостей нет
                </div>
            </>
        );
    }
}

export default HomeView;
