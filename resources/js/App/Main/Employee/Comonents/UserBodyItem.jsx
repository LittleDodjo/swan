import React, {Component} from 'react';
import toast from "react-hot-toast";

class UserBodyItem extends Component {

    constructor(props) {
        super(props);


    }

    async copy(text) {
        if (this.props.id) {
            toast.success("Информация скопирована");
            await navigator.clipboard.writeText(text);
        }
    }

    render() {
        return (
            <div className="flex hover:bg-gray-50 p-4 cursor-pointer" onClick={() => this.copy(this.props.data)}>
                <div className="basis-2/6 my-auto">{this.props.caption}</div>
                {this.props.id ?
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
