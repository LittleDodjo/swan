import React, {Component} from 'react';
import Sidebar from "./SidebarView";

class MainView extends Component {

    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <div className="subsystem-base">
                <Sidebar/>
                <main className="main-subsystem-base" id="scrollableDiv">
                    {this.props.view}
                </main>
            </div>
        );
    }
}

export default MainView;
