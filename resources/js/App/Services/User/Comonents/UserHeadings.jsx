import React, {Component} from 'react';

class UserHeadings extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="cursor-pointer ml-4 my-auto">
                <h1 className="text-xl font-light">{this.props.fullName}</h1>
                <p className="text-xs text-slate-500">{this.props.appointment}</p>
            </div>
        );
    }
}

export default UserHeadings;
