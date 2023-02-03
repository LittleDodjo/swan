import React, {Component} from 'react';
import Back24 from "../Resources/Back24";
import withRouter from "../../withRouter";

class Header extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="bg-white border-b flex justify-between">
                <div className="flex m-4">
                    {this.props.back ?
                        <Back24 action={() => this.props.navigate(this.props.url)}/>
                        : ""}
                    <p className="text-2xl font-light">
                        {this.props.heading}
                    </p>
                </div>
                <div className="flex">
                    {this.props.children}
                </div>
            </div>
        );
    }
}

export default withRouter(Header);
