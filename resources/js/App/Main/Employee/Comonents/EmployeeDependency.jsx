import React, {Component} from 'react';
import EmployeeProvider from "../../../Providers/EmployeeProvider";
import EmployeeBodyItem from "./EmployeeBodyItem";

class EmployeeDependency extends Component {

    constructor(props) {
        super(props);
    }


    render() {
        const depends = EmployeeProvider.getDepends(this.props.dependency);
        return (
            <div className="my-2 border-y bg-white">
                <div className="border-b p-4">
                    <p className="text-xl font-light">Зависимости сотрудника</p>
                </div>
                <div className="divide-y">
                    {depends.map((data, key) => (
                        <EmployeeBodyItem key={key} data={data}/>
                    ))}
                </div>
            </div>
        );
    }
}

export default EmployeeDependency;
