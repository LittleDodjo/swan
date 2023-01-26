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
import OutgoingCreateView from "./Main/Outgoing/OutgoingCreateView";
import OutgoingDocumentView from "./Main/Outgoing/OutgoingDocumentView";

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
                <Route exact  path="/app" element={
                    this.props.authState ? <MainView view={<HomeView/>}/> : <Navigate to="/"/>
                }/>
                <Route exact  path="/app/employee/:id" element={
                    this.props.authState ? <MainView view={<UserView/>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/employee" element={
                    this.props.authState ? <MainView view={<UserView/>}/> : <Navigate to="/"/>
                }/>
                <Route exact path="/app/edep/:id" element={
                    this.props.authState ? <MainView view={<>edep</>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/mdep/:id" element={
                    this.props.authState ? <MainView view={<>mdep</>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/management/:id" element={
                    this.props.authState ? <MainView view={<>management</>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/outgoing" element={
                    this.props.authState ? <MainView view={<OutgoingView/>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/create/outgoing" element={
                    this.props.authState ? <MainView view={<OutgoingCreateView/>}/> : <Navigate to="/"/>
                }/>
                <Route  path="/app/outgoing/:id" element={
                    this.props.authState ? <MainView view={<OutgoingDocumentView/>}/> : <Navigate to="/"/>
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
