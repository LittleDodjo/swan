import React, {Component} from 'react';
import NotificationsView from "./Main/Notifications/NotificationsView";
import MainView from "./Main/MainView";
import ChatView from "./Main/Chats/ChatView";
import HomeView from "./Main/Home/HomeView";
import EmployeeView from "./Main/Employee/EmployeeView";
import OutgoingView from "./Main/Outgoing/ViewAll/OutgoingView";
import OutgoingCreateView from "./Main/Outgoing/Create/OutgoingCreateView";
import OutgoingDocumentView from "./Main/Outgoing/View/OutgoingDocumentView";
import IngoingView from "./Main/Ingoing/IngoingView";
import MarksView from "./Main/Marks/MarksView";
import ReportsView from "./Main/Reports/ReportsView";
import {Navigate, Routes, Route} from 'react-router-dom';
import AdminView from "./Main/Admin/AdminView";

class AppRoutes extends Component {

    constructor(props) {
        super(props);

    }

    render() {
        return (
            <Routes>
                <>
                    <Route exact path='/' element={
                        this.props.authState ? <Navigate to="/app/marks"/> : this.props.children
                    }/>
                    <Route exact path="/app" element={
                        this.props.authState ? <MainView view={<HomeView/>}/> : <Navigate to="/"/>
                    }/>
                    <Route path="/app/notification" element={
                        this.props.authState ? <MainView view={<NotificationsView/>}/> : <Navigate to="/"/>
                    }/>
                    <Route path="/app/chat" element={
                        this.props.authState ? <MainView view={<ChatView/>}/> : <Navigate to="/"/>
                    }/>
                    <Route exact path="/app/employee/:id" element={
                        this.props.authState ? <MainView view={<EmployeeView/>}/> : <Navigate to="/"/>
                    }/>
                    <Route path="/app/employee" element={
                        this.props.authState ? <MainView view={<EmployeeView/>}/> : <Navigate to="/"/>
                    }/>
                    <Route path="/app/management/:id" element={
                        this.props.authState ? <MainView view={<>management</>}/> : <Navigate to="/"/>
                    }/>
                    <Route exact path="/app/edep/:id" element={
                        this.props.authState ? <MainView view={<>edep</>}/> : <Navigate to="/"/>
                    }/>
                    <Route path="/app/mdep/:id" element={
                        this.props.authState ? <MainView view={<>mdep</>}/> : <Navigate to="/"/>
                    }/>
                    <Route path="/app/reports" element={
                        this.props.authState ? <MainView view={<ReportsView/>}/> : <Navigate to="/"/>
                    }/>
                    <Route path="/app/admin" element={
                        this.props.authState ? <MainView view={<AdminView/>}/> : <Navigate to="/"/>
                    }/>
                </>
                <>
                    <Route path="/app/outgoing" element={
                        this.props.authState ? <MainView view={<OutgoingView/>}/> : <Navigate to="/"/>
                    }/>
                    <Route path="/app/create/outgoing" element={
                        this.props.authState ? <MainView view={<OutgoingCreateView/>}/> : <Navigate to="/"/>
                    }/>
                    <Route path="/app/outgoing/:id" element={
                        this.props.authState ? <MainView view={<OutgoingDocumentView/>}/> : <Navigate to="/"/>
                    }/>
                    <Route path="/app/marks" element={
                        this.props.authState ? <MainView view={<MarksView/>}/> : <Navigate to="/"/>
                    }/>
                </>
                <>
                    <Route path="/app/ingoing" element={
                        this.props.authState ? <MainView view={<IngoingView/>}/> : <Navigate to="/"/>
                    }/>
                    <Route path="/app/ingoing/:id" element={
                        this.props.authState ? <MainView view={<IngoingView/>}/> : <Navigate to="/"/>
                    }/>
                </>
            </Routes>
        );
    }
}

export default AppRoutes;


