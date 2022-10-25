import React, {Component} from 'react';
import SidebarButton from "./Common/Components/SidebarButton";
import MainResource from "./Common/Resources/MainResource";
import OutgoingResource from "./Common/Resources/OutgoingResource";
import IncomingResource from "./Common/Resources/IncomingResource";
import SecretaryResource from "./Common/Resources/SecretaryResource";
import ControlDocumentResource from "./Common/Resources/ControlDocumentResource";
import ChatResource from "./Common/Resources/ChatResource";
import ReportsResource from "./Common/Resources/ReportsResource";

class Sidebar extends Component {

    constructor(props) {
        super(props);
        this.state = {}

        this.handleClick = this.handleClick.bind(this);
    }

    handleClick(id){
        this.props.menuHandler(id);
    }

    componentDidMount() {

    }


    render() {
        return (
            <aside className="aside-box">
                <ul className="side-menu">
                    <SidebarButton resource={<MainResource/>} action={this.handleClick} id={0}/>
                    <SidebarButton resource={<OutgoingResource/>} action={this.handleClick} id={1}/>
                    <SidebarButton resource={<IncomingResource/>} action={this.handleClick} id={2}/>
                    <SidebarButton resource={<SecretaryResource/>} action={this.handleClick} id={3}/>
                    <SidebarButton resource={<ControlDocumentResource/>} action={this.handleClick} id={4}/>
                    <SidebarButton resource={<ChatResource/>} action={this.handleClick} id={5}/>
                    <SidebarButton resource={<ReportsResource/>} action={this.handleClick} id={6}/>
                </ul>
                <div className="aside-btn relative w-full">
                    <svg className="m-4 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                         height="24">
                        <path fill="none" d="M0 0h24v24H0z"/>
                        <path
                            d="M5 18h14v-6.969C19 7.148 15.866 4 12 4s-7 3.148-7 7.031V18zm7-16c4.97 0 9 4.043 9 9.031V20H3v-8.969C3 6.043 7.03 2 12 2zM9.5 21h5a2.5 2.5 0 1 1-5 0z"/>
                    </svg>
                    <div
                        className="absolute top-3 right-4 h-4 w-4 rounded-full bg-red-500 text-center text-xs text-white">4
                    </div>
                </div>
            </aside>

        );
    }
}

export default Sidebar;
