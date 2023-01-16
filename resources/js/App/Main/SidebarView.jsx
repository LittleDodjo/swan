import React, {Component} from 'react';
import User24 from "../Common/Resources/User24";
import SidebarButton from "./SidebarButton";
import Home24 from "../Common/Resources/Home24";
import MiniSidebar from "./MiniSidebar";
import Menu24 from "../Common/Resources/Menu24";
import FileUpload24 from "../Common/Resources/FileUpload24";
import FileDownload24 from "../Common/Resources/FileDownload24";
import Report24 from "../Common/Resources/Report24";
import Bookmark24 from "../Common/Resources/Bookmark24";

class Sidebar extends Component {

    constructor(props) {
        super(props);
        this.state = {
            mini: true
        };

        this.openMiniSidebar = this.openMiniSidebar.bind(this);
    }

    openMiniSidebar() {
        this.setState({mini: !this.state.mini});
    }

    render() {
        return (
            <>
                <aside className="aside-box relative">
                    <ul className="side-menu">
                        <SidebarButton  svg={<Home24 class="fill-slate-500"/>} link={"/app"}/>
                        <SidebarButton  svg={<FileUpload24 class="fill-slate-500"/>} link={"/app"}/>
                        <SidebarButton svg={<Bookmark24 class="fill-slate-500"/>} link={"/app"}/>
                        <SidebarButton  svg={<FileDownload24 class="fill-slate-500"/>} link={"/app"}/>
                        <SidebarButton  svg={<Report24 class="fill-slate-500"/>} link={"/app"}/>
                    </ul>
                    <div className="aside-btn relative w-full">
                        <ul className="side-menu">
                            <li onClick={this.openMiniSidebar}>
                                <Menu24 class="fill-slate-500"/>
                            </li>
                        </ul>
                    </div>
                </aside>
                <MiniSidebar state={this.state.mini}/>
            </>
        );
    }
}

export default Sidebar;
