import React, {Component} from 'react';
import UserServiceProvider from "../../Providers/UserServiceProvider";

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
        const userProvider = new UserServiceProvider();
        this.setState(userProvider.me());
    }

    render() {
        if (this.state.employee === null) return (<>loading..</>);
        const employee = this.state.employee;
        return (
            <div className="bg-white p-4 border-b">
                <p className="font-light text-xl">Добрый день, {employee.first_name + " " + employee.last_name}</p>
            </div>
        );
    }
}

export default HomeView;