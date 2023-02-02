import React, {Component} from 'react';
import EmployeeAvatar from "./EmployeeAvatar";

class EmployeeCard extends Component {

    constructor(props) {
        super(props);
        this.state = {

        };

        this.select = this.select.bind(this);
    }

    select(e)
    {
        this.props.action(this.props.id);
        this.props.close(false);
    }


    render() {
        return (
            <div className="employee-card" onClick={this.select}>
                <EmployeeAvatar text={this.props.id}/>
                <div className="flex flex-col ml-4">
                    <p className="text-xl font-light">{this.props.fullName}</p>
                    <p className="hover:text-white text-sm font-light">{this.props.appointment.name}</p>
                </div>
            </div>
        );
    }
}

export default EmployeeCard;
