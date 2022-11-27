import React, {Component} from 'react';
import {BrowserRouter, Navigate, Route, Routes} from 'react-router-dom';
import AppProvider from "./AppProvider/AppProvider";
import MainBase from "./MainViews/MainBase";
import AuthorizeView from "./MainViews/AuthorizeView/AuthorizeView";
import RegisterView from "./MainViews/RegisterView/RegisterView";
import {ToastContainer} from "react-toastify";

class App extends Component {

    constructor(props) {
        super(props);
        this.state = {
            appProvider: new AppProvider(),
            lastRefreshToken: 0,
            auth: false,
        }

        this.getProvider = this.getProvider.bind(this);
        this.willAuthorized = this.willAuthorized.bind(this);
    }

    getProvider() {
        return this.state.appProvider;
    }

    willAuthorized(result) {
        this.setState({auth: result});
        if (result) {
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
    }

    componentDidMount() {
        const provider = this.getProvider();
        this.setState({auth: false});
        provider.willAuthorize(this.willAuthorized);
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
                                    <AuthorizeView appProvider={this.state.appProvider} willAuth={this.willAuthorized}/>
                                </MainBase>
                            </>
                        }/>
                        <Route exact path='/register' element={
                            <>
                                {this.state.auth ? <Navigate to="/app"/> : ""}
                                <MainBase>
                                    <RegisterView appProvider={this.state.appProvider} willAuth={this.willAuthorized}/>
                                </MainBase>
                            </>
                        }/>

                        <Route exact path='/app' element={
                            <>
                                {this.state.auth ?
                                    <>test</>
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
