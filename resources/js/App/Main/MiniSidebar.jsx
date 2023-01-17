import React, {Component} from 'react';
import SidebarButton from "./SidebarButton";
import User24 from "../Common/Resources/User24";
import Notification24 from "../Common/Resources/Notification24";
import Chat24 from "../Common/Resources/Chat24";

class MiniSidebar extends Component {

    constructor(props) {
        super(props);

        this.wrapperRef = React.createRef();
        this.handleClickOutside = this.handleClickOutside.bind(this)
    }

    componentDidMount() {
        this.setState({isOpen: this.props.state});
        document.addEventListener("mousedown", this.handleClickOutside);
    }

    componentWillUnmount() {
        document.removeEventListener("mousedown", this.handleClickOutside);
    }

    handleClickOutside(event) {
        if (this.wrapperRef && !this.wrapperRef.current.contains(event.target)) {
            this.props.action(false);
        }
    }


    render() {
        const hidden = this.props.state ? "" : " hidden";
        return (
            <div className={"mini-sidebar " + hidden} ref={this.wrapperRef} onClick={() => this.props.action(false)}>
                <ul className="side-menu">
                    <SidebarButton link="/app/notification" svg={<Notification24/>} caption={"Уведомления"}/>
                    <SidebarButton link="/app/employee" svg={<User24/>} caption={"Профиль"}/>
                    <SidebarButton link="/app/chat" svg={<Chat24/>} caption={"Чаты"}/>
                </ul>
            </div>
        );
    }
}

export default MiniSidebar;
