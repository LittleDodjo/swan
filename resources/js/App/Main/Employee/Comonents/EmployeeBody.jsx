import React, {Component} from 'react';
import EmployeeBodyItem from "./EmployeeBodyItem";
import EmployeeDependency from "./EmployeeDependency";
import withRouter from "../../../withRouter";
import EmployeeProvider from "../../../Providers/EmployeeProvider";
import EmployeeRoles from "./EmployeeRoles";

class EmployeeBody extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <>
                {!this.props.me && this.props.employee.user === null ?
                    <div className="border-y mt-2 p-2 bg-white text-center text-slate-500">У данного сотрудника нет
                        учетной записи</div> : ""}

                {this.props.me && !this.props.user.confirmed ?
                    <div className="border-y mt-2 p-2 bg-white text-center text-slate-500">Учетная запись не
                        подтверждена, обратитесь к администратору</div> : ""}

                <div className="my-2 border-y bg-white">
                    <div className="border-b p-4 flex">
                        <p className="text-xl font-light">Данные сотрудника</p>
                        <p className="my-auto px-4 hover:underline hover:underline-offset-4 italic font-light text-indigo-500 cursor-pointer">
                            @{this.props.employee.id}
                        </p>
                    </div>
                    <div className="divide-y">
                        <EmployeeBodyItem data={{type:"Организация",caption: this.props.employee.organization.name}}/>
                        <EmployeeBodyItem data={{type:"Почта", caption: this.props.employee.email}}/>
                        {this.props.me ? <EmployeeBodyItem  data={{type:"Логин", caption: this.props.user.login}}/> : ""}
                        <EmployeeBodyItem data={{type:"Телефон" , caption: this.props.employee.phone}}/>
                        <EmployeeBodyItem  data={{type:"Номер кабинета", caption: this.props.employee.cabinet}}/>
                        <EmployeeRoles roles={EmployeeProvider.getRoles(this.props.employee, this.props.roles)}/>
                    </div>

                </div>

                {this.props.employee.rank < 7 ?
                    <EmployeeDependency dependency={this.props.employee.dependency}/> : <>/</>}
            </>
        );
    }
}

export default withRouter(EmployeeBody);
