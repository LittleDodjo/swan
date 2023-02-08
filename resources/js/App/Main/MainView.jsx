import React, {Component} from 'react';
import Sidebar from "./SidebarView";
import AppServiceProvider from "../Providers/AppServiceProvider";
import OrganizationProvider from "../Providers/OrganizationProvider";
import CookieProvider from "../Providers/CookieProvider";
import StampProvider from "../Providers/StampProvider";

class MainView extends Component {

    constructor(props) {
        super(props);
        this.state = {

        };
    }

    componentDidMount() {
        if(AppServiceProvider.isOutgoing() || AppServiceProvider.isIngoing()){
            OrganizationProvider.index((res) => {
                if(res.status === 200) {
                    CookieProvider.writeSession('organizationRegister', res.data);
                }
            });
        }
        if(AppServiceProvider.isIngoing()){
            StampProvider.index((res) => {
                if(res.status === 200) {
                    CookieProvider.writeSession('stampsRegister', res.data);
                }
            });
        }
    }

    render() {
        return (
            <div className="subsystem-base">
                <Sidebar/>
                <main className="main-subsystem-base" id={"ref"}>
                    {this.props.view}
                </main>
            </div>
        );
    }
}

export default MainView;
