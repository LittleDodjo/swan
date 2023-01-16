import React, {Component} from 'react';
import SidebarButton from "./SidebarButton";
import User24 from "../Common/Resources/User24";
import Notification24 from "../Common/Resources/Notification24";
import Chat24 from "../Common/Resources/Chat24";

class MiniSidebar extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        const hidden = this.props.state ? "" : " hidden";
        return (
            <div className={"mini-sidebar " + hidden}>
                <ul className={"side-menu"}>
                    <SidebarButton link="/app/notification" svg={<Notification24 class="fill-slate-500"/>}/>
                    <SidebarButton link="/app/employee" svg={<User24 class="fill-slate-500"/>}/>
                    <SidebarButton link="/app/chat" svg={<Chat24 class="fill-slate-500"/>}/>
                </ul>
            </div>
        );
    }
}

export default MiniSidebar;
