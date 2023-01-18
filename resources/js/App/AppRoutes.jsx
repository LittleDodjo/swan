import React, {Component} from 'react';
import {Navigate, Route, Routes} from 'react-router-dom';
import MainView from "./Main/MainView";
import HomeView from "./Main/Home/HomeView";
import UserView from "./Main/Employee/EmployeeView";
import NotificationsView from "./Main/Notifications/NotificationsView";
import ChatView from "./Main/Chats/ChatView";
import ReportsView from "./Main/Reports/ReportsView";
import MarksView from "./Main/Marks/MarksView";
import IngoingView from "./Main/Ingoing/IngoingView";
import OutgoingView from "./Main/Outgoing/OutgoingView";

class AppRoutes extends Component {

    constructor(props) {
        super(props);

    }

    render() {
        return (
            <Routes>
                <Route exact path='/' element={
                    this.props.authState ? <Navigate to="/app/outgoing"/> : this.props.children
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
                <Route  path="/app/outgoing" element={
                    this.props.authState ? <MainView view={<OutgoingView/>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/outgoing/:id" element={
                    this.props.authState ? <MainView view={<OutgoingView/>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/ingoing" element={
                    this.props.authState ? <MainView view={<IngoingView/>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/ingoing/:id" element={
                    this.props.authState ? <MainView view={<IngoingView/>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/marks" element={
                    this.props.authState ? <MainView view={<MarksView/>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/reports" element={
                    this.props.authState ? <MainView view={<ReportsView/>}/> : <Navigate to="/"/>
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
