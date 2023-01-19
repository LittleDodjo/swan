import React, {Component} from 'react';
import EmployeeAvatar from "../../../Common/Components/EmployeeAvatar";

class EmployeeHeadings extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <>
                <EmployeeAvatar text={this.props.avatar}/>
                <div className="cursor-pointer ml-4 my-auto">
                    <h1 className="text-xl font-light">{this.props.fullName}</h1>
                    <p className="text-xs text-slate-500">{this.props.appointment}</p>
                </div>
            </>
        );
    }
}

export default EmployeeHeadings;
