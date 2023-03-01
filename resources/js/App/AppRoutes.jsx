import React, {Component} from 'react';
import MainView from "./Main/MainView";
import EmployeeView from "./Main/Employee/EmployeeView";
import MarksView from "./Main/Marks/MarksView";
import {Navigate, Routes, Route} from 'react-router-dom';
import OutgoingIndex from "./Main/Outgoing/Index/OutgoingIndex";
import OutgoingStore from "./Main/Outgoing/Store/OutgoingStore";
import OutgoingShow from "./Main/Outgoing/Show/OutgoingShow";
import OutgoingUpdate from "./Main/Outgoing/Update/OutgoingUpdate";


class AppRoutes extends Component {

    constructor(props) {
        super(props);

    }

    render() {
        return (
            <Routes>
                <Route exact path='/' element={
                    this.props.authState ? <Navigate to="/app/outgoing/edit/5"/> : this.props.children
                }/>
                <Route path="/app/outgoing" element={
                    this.props.authState ? <MainView view={<OutgoingIndex/>}/> : <Navigate to="/"/>
                }/>
                <Route path="/app/create/outgoing" element={
                    this.props.authState ? <MainView view={<OutgoingStore/>}/> : <Navigate to="/"/>
                }/>
                <Route path="/app/outgoing/:id" element={
                    this.props.authState ? <MainView view={<OutgoingShow/>}/> : <Navigate to="/"/>
                }/>
                <Route path="/app/outgoing/edit/:id" element={
                    this.props.authState ? <MainView view={<OutgoingUpdate/>}/> : <Navigate to="/"/>
                }/>
                <Route path="/app/marks" element={
                    this.props.authState ? <MainView view={<MarksView/>}/> : <Navigate to="/"/>
                }/>
            </Routes>
        );
    }
}

export default AppRoutes;


