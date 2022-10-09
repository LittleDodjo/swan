import React, {Component} from 'react';
import {Routes, Navigate, Route} from 'react-router-dom';
import SubsystemBase from './Subsystems/SubsystemBase'; // Каркас
import MainBase from "./MainViews/MainBase";
import AuthorizeView from "./MainViews/AuthorizeView/AuthorizeView";

class AppRouter extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <Routes>
                <Route exact path='/' element={
                    <MainBase>
                        <AuthorizeView/>
                    </MainBase>
                }/>

                <Route exact path='/register' element={
                    <MainBase>
                        register
                    </MainBase>
                }/>

                <Route exact path='/app' element={
                    <SubsystemBase>
                        test
                    </SubsystemBase>
                }/>
            </Routes>
        );
    }
}

export default AppRouter;
