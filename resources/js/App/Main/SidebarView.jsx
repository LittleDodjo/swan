import React, {Component} from 'react';
import User24 from "../Common/Resources/User24";
import SidebarButton from "./SidebarButton";
import Home24 from "../Common/Resources/Home24";
import FileUpload24 from "../Common/Resources/FileUpload24";
import FileDownload24 from "../Common/Resources/FileDownload24";
import Report24 from "../Common/Resources/Report24";
import Bookmark24 from "../Common/Resources/Bookmark24";
import Chat24 from "../Common/Resources/Chat24";
import Notification24 from "../Common/Resources/Notification24";

class Sidebar extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <>
                <aside className="aside-box relative">
                    <ul className="side-menu">
                        <SidebarButton svg={<Home24/>} link={"/app"} caption="Главная"/>
                        <SidebarButton svg={<FileUpload24/>} link={"/app/outgoing"} caption="Исходящие"/>
                        <SidebarButton svg={<FileDownload24/>} link={"/app/ingoing"} caption="Входящие"/>
                        <SidebarButton svg={<Report24/>} link={"/app/reports"} caption="Отчеты"/>
                        <SidebarButton link="/app/employee" svg={<User24/>} caption={"Профиль"}/>
                    </ul>
                    <div className="aside-btn relative w-full">
                        <ul className="side-menu">
                            <SidebarButton link="/app/chat" svg={<Chat24/>} caption={"Чаты"}/>
                        </ul>
                    </div>
                    <div className="aside-btn relative w-full">
                        <ul className="side-menu">
                            <SidebarButton link="/app/notification" svg={<Notification24/>} caption={"Уведомления"}/>
                        </ul>
                    </div>
                </aside>
            </>
        );
    }
}

export default Sidebar;
