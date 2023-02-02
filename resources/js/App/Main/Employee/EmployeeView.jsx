import React, {Component} from 'react';
import toast from "react-hot-toast";
import withRouter from "../../withRouter";
import EmployeeProvider from "../../Providers/EmployeeProvider";
import EmployeeHeader from "./Comonents/EmployeeHeader";
import EmployeeBody from "./Comonents/EmployeeBody";
import EmployeeSettings from "./EmployeeSettings";
import EmployeeAdmin from "./EmployeeAdmin";

class EmployeeView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            employee: null,
            admin: false,
            settings: false,
        }

        this.settings = this.settings.bind(this);
        this.admin = this.admin.bind(this);
    }

    settings(state) {
        this.setState({settings: state});
    }

    admin(state) {
        this.setState({admin: state});
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        if (this.props.params.id !== prevProps.params.id) {
            this.forceUpdate(() => {
                EmployeeProvider.employee(this.props.params.id, (response) => {
                    if (response.status === 404) {
                        toast.error("Такой пользователь не найден");
                    }
                    if (response.status === 200) {
                        this.setState({employee: response.employee});
                    }
                });
            });
        }
    }

    componentDidMount() {
        if (!this.props.params.id) {
            this.setState({employee: JSON.parse(sessionStorage.getItem("employee"))});
        } else {
            EmployeeProvider.employee(this.props.params.id, (response) => {
                if (response.status === 404) {
                    toast.error("Такой пользователь не найден");
                }
                if (response.status === 200) {
                    this.setState({employee: response.employee});
                }
            });
        }
    }

    render() {
        if (this.state.employee === null) return <>loading</>;
        const employee = this.state.employee
        const data = {
            avatar: employee.first_name[0] + employee.last_name[0],
            fullName: employee.full_name,
            appointment: employee.appointment.name,
            isAdmin: (this.props.roles.is_admin || this.props.roles.is_root),
            me: !this.props.params.id,
        };
        return (
            <div className="body-view">
                <EmployeeHeader me={!this.props.params.id} data={data} admin={this.admin} settings={this.settings}/>
                <EmployeeBody me={!this.props.params.id} employee={employee}/>
                <EmployeeSettings state={this.state.settings} action={this.settings}/>
                <EmployeeAdmin state={this.state.admin} action={this.admin}/>
            </div>
        );
    }
}

export default withRouter(EmployeeView);
