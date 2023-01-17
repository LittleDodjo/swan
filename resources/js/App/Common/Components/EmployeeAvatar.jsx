import React, {Component} from 'react';

class EmployeeAvatar extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="user-avatar">
                <p className="">{this.props.text}</p>
            </div>
        );
    }
}

export default EmployeeAvatar;
