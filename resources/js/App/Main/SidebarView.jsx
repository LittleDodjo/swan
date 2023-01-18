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
            mini: false
        };

        this.miniSidebar = this.miniSidebar.bind(this);
    }

    miniSidebar(state) {
        this.setState({mini: state});
    }


    render() {
        return (
            <>
                <aside className="aside-box relative">
                    <ul className="side-menu">
                        <SidebarButton svg={<Home24/>} link={"/app"}/>
                        <SidebarButton svg={<FileUpload24/>} link={"/app/outgoing"}/>
                        <SidebarButton svg={<Bookmark24/>} link={"/app/marks"}/>
                        <SidebarButton svg={<FileDownload24/>} link={"/app/ingoing"}/>
                        <SidebarButton svg={<Report24/>} link={"/app/reports"}/>
                    </ul>
                    <div className="aside-btn relative w-full" onClick={() => this.miniSidebar(!this.state.mini)}>
                        <ul className="side-menu">
                            <SidebarButton svg={<Menu24/>}/>
                        </ul>
                    </div>
                </aside>
                <MiniSidebar action={this.miniSidebar} state={this.state.mini}/>
            </>
        );
    }
}

export default Sidebar;
