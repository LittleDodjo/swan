import React, {Component} from 'react';
import UserServiceProvider from "../../../Providers/UserServiceProvider";

class DependenciesUser extends Component {

    constructor(props) {
        super(props);
        this.state = {};
    }

    componentDidMount() {
        console.log(this.props.dependency)
    }

    render() {
        const userProvider = new UserServiceProvider();
        const depends = userProvider.getDepends(this.props.dependency);
        if (depends) return (
            <></>
        );
        return (
            <div className="my-2 border-y bg-white">
                <div className="border-b p-4">
                    <p className="text-xl font-light">Зависимости сотрудника</p>
                </div>
                <div className="flex flex-col divide-y">
                    <div className="p-4 bg-slate-400 flex">
                        <p className="basis-2/6">Начальник</p>
                        <p>Щека такой-то</p>
                    </div>
                    <div className="p-4 bg-slate-400 flex">
                        <p className="basis-2/6">Отдел</p>
                        <p>Наименование отдела</p>
                    </div>
                </div>
            </div>
        );
    }
}

export default DependenciesUser;
