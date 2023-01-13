import React, {Component} from 'react';
import UserServiceProvider from "../../../Providers/UserServiceProvider";
import UserBodyItem from "./UserBodyItem";

class DependenciesUser extends Component {

    constructor(props) {
        super(props);
        this.state = {
            depends: null
        };

        this.depends = this.depends.bind(this);
    }

    depends() {
        const userProvider = new UserServiceProvider();
        const result = userProvider.getDepends(this.props.dependency);
        this.setState({depends: result})
    }

    componentDidMount() {
        this.depends();
    }

    render() {
        if (this.state.depends === null) return <></>
        return (
            <div className="my-2 border-y bg-white">
                <div className="border-b p-4">
                    <p className="text-xl font-light">Зависимости сотрудника</p>
                </div>
                <div className="divide-y">
                    {this.state.depends.map((data, key) => (
                        <UserBodyItem openUser={this.props.openUser} key={key} data={data.caption} caption={data.type} id={data.id}/>
                    ))}
                </div>
            </div>
        );
    }
}

export default DependenciesUser;
