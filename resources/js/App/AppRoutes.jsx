import React, {Component} from 'react';
import {Navigate, Route, Routes} from 'react-router-dom';
import MainView from "./Main/MainView";
import HomeView from "./Main/Home/HomeView";
import UserView from "./Main/Employee/UserView";
import Notification from "react-notifications/lib/Notification";
import NotificationsView from "./Main/Notifications/NotificationsView";
import ChatView from "./Main/Chats/ChatView";

class AppRoutes extends Component {

    constructor(props) {
        super(props);

    }

    render() {
        return (
            <Routes>
                <Route exact path='/' element={
                    this.props.authState ? <Navigate to="/app"/> : this.props.children
                }/>
                <Route  path="/app" element={
                    this.props.authState ? <MainView view={<HomeView/>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/employee/:id" element={
                    this.props.authState ? <MainView view={<UserView/>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/employee" element={
                    this.props.authState ? <MainView view={<UserView id={0}/>}/> : <Navigate to="/"/>
                }/>

                <Route  path="/app/notification" element={
                    this.props.authState ? <MainView view={<NotificationsView/>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/chat" element={
                    this.props.authState ? <MainView view={<ChatView/>}/> : <Navigate to="/"/>
                }/>
            </Routes>
        );
    }
}

export default AppRoutes;
