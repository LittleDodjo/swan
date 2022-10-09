import React, {Component} from 'react';
import UserProvider from "../ServiceProvider/UserProvider";

class MainSubsystem extends Component {

    constructor(props) {
        super(props);
        this.state = {
            userName: "test",
            userProvider: new UserProvider()
        };
    }

    componentDidMount() {
        const provider = this.state.userProvider.getAppProvider();
        const user = provider.getUser();
        this.setState({userName: user.first_name});
        console.log(provider.getUser());
    }

    render() {
        return (
            <div>
                Добрый день, {this.state.userName}, данный раздел находится в разработке!
            </div>
        );
    }
}

export default MainSubsystem;