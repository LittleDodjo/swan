import React, {Component} from 'react';
import {Routes, Navigate, Route} from 'react-router-dom';
import SubsystemBase from './Subsystems/SubsystemBase'; // Каркас
import AppProvider from "./AppProvider/AppProvider";
import MainBase from "./MainViews/MainBase";
import AuthorizeView from "./MainViews/AuthorizeView/AuthorizeView";

class AppRouter extends Component {

    constructor(props) {
        super(props);
        this.state = {
            appProvider: new AppProvider(),
            lastRefreshToken: 0,
            auth: false,
        }
        this.saveUser = this.saveUser.bind(this);
        this.getProvider = this.getProvider.bind(this);
        this.unauthorized = this.unauthorized.bind(this);
    }

    getProvider() {
        return this.state.appProvider;
    }

    saveUser(token, user) {
        this.setState({auth: true, lastRefreshToken: 0});
        this.state.appProvider.saveAuth(token, user);
    }

    unauthorized() {
        this.setState({auth: false, lastRefreshToken: 0});
    }

    componentDidMount() {
        const time = this.state.appProvider.getTokenTime();
        if (time !== false) {
            this.setState({lastRefreshToken: time, auth: true});
        }
        this.interval = setInterval(
            () => {
                if (this.state.lastRefreshToken > 720) {
                    this.state.appProvider.willAuthorized(this.unauthorized, this.saveUser);
                }
                this.setState((prevState) => ({
                    lastRefreshToken: prevState.lastRefreshToken + 1
                }));
                this.state.appProvider.updateTokenTime(this.state.lastRefreshToken);
            },
            1000);
    }

    componentWillUnmount() {
        clearInterval(this.interval);
    }


    render() {
        return (
            <Routes>
                <Route exact path='/' element={
                    <>
                        {this.state.auth ? <Navigate to="/app"/> : ""}
                        <MainBase>
                            <AuthorizeView saveUser={this.saveUser}
                                           authProvider={this.state.appProvider.getAuthProvider()}/>
                        </MainBase>
                    </>
                }/>
                <Route exact path='/register' element={
                    <MainBase>
                        register
                    </MainBase>}
                />

                <Route exact path='/app' element={
                    <>
                        {this.state.auth ?
                            <SubsystemBase/>
                            : <Navigate to="/"/>
                        }
                    </>
                }/>
            </Routes>
        );
    }
}

export default AppRouter;
