import React, {Component} from 'react';

class UserBodyItem extends Component {

    constructor(props) {
        super(props);


    }


    render() {
        return (
            <div className="flex hover:bg-gray-50 p-4 cursor-pointer">
                <div className="basis-2/6 my-auto">{this.props.caption}</div>
                {this.props.id !== null ?
                    <div className="my-auto">
                        <p className="hover:underline hover:text-indigo-500 cursor-pointer"
                           onClick={(id) => this.props.openUser(this.props.id)}>{this.props.data}</p>
                    </div>
                    : <div className="my-auto">{this.props.data}</div>}

            </div>
        );
    }
}

export default UserBodyItem;
