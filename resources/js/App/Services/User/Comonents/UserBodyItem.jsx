import React, {Component} from 'react';

class UserBodyItem extends Component {
    render() {
        return (
            <div className="flex hover:bg-gray-50 p-4">
                <div className="basis-2/6 my-auto">{this.props.caption}</div>
                <div className="my-auto">{this.props.data}</div>
            </div>
        );
    }
}

export default UserBodyItem;
