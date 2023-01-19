import React, {Component} from 'react';

class EmployeeRoles extends Component {


    render() {
        return (
            <div className="flex hover:bg-gray-50 p-4">
                <div className="basis-2/6 my-auto">Роли</div>
                <div className="my-auto flex">
                    {this.props.roles.map((data, key) => (
                        <p className="cursor-pointer mx-2 rounded-full border border-indigo-400 bg-slate-100 p-2 text-sm font-light"
                           key={key}>{data}</p>
                    ))}
                </div>
            </div>
        );
    }
}

export default EmployeeRoles;
