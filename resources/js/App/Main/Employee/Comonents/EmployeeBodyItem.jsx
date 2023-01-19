import React, {Component} from 'react';
import toast from "react-hot-toast";
import RedirectLink from "../../../Common/Components/RedirectLink";

class EmployeeBodyItem extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        if (!this.props.data) return <></>
        return (
            <div className="flex hover:bg-gray-50 p-4 cursor-pointer">
                <div className="basis-2/6 my-auto">{this.props.data.type}</div>
                {this.props.data.id ? <RedirectLink caption={this.props.data.caption}
                                                    link={"/app/" + this.props.data.link + "/" + this.props.data.id}/>
                    : <div className="my-auto">{this.props.data.caption}</div>}
            </div>
        );
    }

}

export default EmployeeBodyItem;
