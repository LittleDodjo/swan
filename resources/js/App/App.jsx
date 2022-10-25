import React, {Component} from 'react';
import {ToastContainer} from "react-toastify";
import {BrowserRouter, Navigate, Route, Routes} from 'react-router-dom';
import AppProvider from "./AppProvider/AppProvider";
import MainBase from "./MainViews/MainBase";
import AuthorizeView from "./MainViews/AuthorizeView/AuthorizeView";
import RegisterView from "./MainViews/RegisterView/RegisterView";
import SubsystemBase from "./Subsystems/SubsystemBase";


class App extends Component {

    constructor(props) {
        super(props);
        this.state = {
            appProvider: new AppProvider(),
            maxTokenTime: 720,
            lastRefreshToken: 0,
            refreshTokenInterval: null,
            auth: false,
        }

        this.getProvider = this.getProvider.bind(this);
        this.updateAuth = this.updateAuth.bind(this);
    }

    getProvider() {
        return this.state.appProvider;
    }

    updateAuth(result) {
        this.setState({auth: result});
    }

    componentDidMount() {
        const appProvider = this.getProvider();
        appProvider.checkAuth(this.updateAuth);
        const interval = setInterval(() => {
            const maxTokenTime = this.state.maxTokenTime;
            if (this.state.auth === false) return;
            if (this.state.lastRefreshToken >= maxTokenTime) {
                appProvider.checkAuth(this.updateAuth);
                this.setState({lastRefreshToken: 0});
            }
            this.setState((prevState) => ({
                lastRefreshToken: prevState.lastRefreshToken + 1
            }));
        }, 1000);
        this.setState({refreshTokenInterval: interval});
    }


    componentWillUnmount() {
        clearInterval(this.state.refreshTokenInterval);
    }

    render() {
        return (
            <>
                <ToastContainer/>
                <BrowserRouter>
                    <Routes>
                        <Route exact path='/' element={
                            <>
                                {this.state.auth ? <Navigate to="/app"/> : ""}
                                <MainBase>
                                    <AuthorizeView appProvider={this.state.appProvider} willAuth={this.updateAuth}/>
                                </MainBase>
                            </>
                        }/>
                        <Route exact path='/register' element={
                            <>
                                {this.state.auth ? <Navigate to="/app"/> : ""}
                                <MainBase>
                                    <RegisterView willAuth={this.updateAuth}/>
                                </MainBase>
                            </>
                        }/>

                        <Route exact path='/app' element={
                            <>
                                {this.state.auth ?
                                    <SubsystemBase willAuth={this.updateAuth}/>
                                    : <Navigate to="/"/>
                                }
                            </>
                        }/>
                    </Routes>
                </BrowserRouter>
            </>
        );
    }
}

export default App;
