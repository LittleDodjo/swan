import React, {Component} from 'react';
import Sidebar from "./SidebarView";
import UserView from "./User/UserView";

class MainAppView extends Component {

    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <div className="subsystem-base">
                <Sidebar/>
                <main className="main-subsystem-base">
                    <UserView/>
                </main>
            </div>
        );
    }
}

export default MainAppView;
