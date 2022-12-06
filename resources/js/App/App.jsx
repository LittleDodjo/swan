import React, {Component} from 'react';
import {Toaster} from 'react-hot-toast';
import {BrowserRouter, Navigate, Route, Routes} from 'react-router-dom';
import AuthView from "./Main/AuthView";
import AppServiceProvider from "./Providers/AppServiceProvider";
import Loading from "./Common/Resources/Loading";
import MainAppView from "./Services/MainAppView";

class App extends Component {

    constructor(props) {
        super(props);
        this.state = {
            authState: false,
            maxTokenTime: 700,
            lastRefresh: 0,
            refreshTokenInterval: null,
            loading: true,
        };

        this.authAction = this.authAction.bind(this);
        this.refreshAuth = this.refreshAuth.bind(this);
    }

    authAction(data) {
        if (data.code === 200) {
            this.setState({authState: true});
        } else {
            sessionStorage.removeItem('authorization');
            this.setState({authState: false});
        }
    }

    refreshAuth(data) {
        if (data.code === 200) {
            this.setState({authState: true});
            const appProvider = new AppServiceProvider();
            appProvider.saveRefresh(data.authorization);
        } else {
            sessionStorage.removeItem('authorization');
            this.setState({authState: false});
        }
    }

    componentDidMount() {
        this.setState({loading: false});
        const appProvider = new AppServiceProvider();
        appProvider.checkAuth(this.refreshAuth);
        const interval = setInterval(() => {
            const maxTokenTime = this.state.maxTokenTime;
            if (this.state.authState === false) return;
            if (this.state.lastRefresh >= maxTokenTime) {
                appProvider.checkAuth(this.refreshAuth);
                this.setState({lastRefresh: 0});
            }
            this.setState((prevState) => ({
                lastRefresh: prevState.lastRefresh + 1
            }));
        }, 1000);
        this.setState({refreshTokenInterval: interval});
    }

    render() {
        if (!this.state.loading)
            return (
                <>
                    <Toaster position="bottom-right"/>
                    <BrowserRouter>
                        <Routes>
                            <Route exact path='/' element={
                                this.state.authState ? <Navigate to="/app"/> : <AuthView action={this.authAction}/>
                            }/>
                            <Route exact path="/app" element={
                                this.state.authState ? <MainAppView/> : <Navigate to="/"/>
                            }/>
                        </Routes>
                    </BrowserRouter>
                </>
            );
        else return (
            <div className="h-screen w-screen flex justify-center">
                <div className="my-auto ">
                    <div className="justify-center flex my-4">
                        <Loading/>
                    </div>
                    <div className="mx-auto my-4">
                        <h1 className="text-center font-light">Подождите, приложение загружается</h1>
                    </div>
                </div>
            </div>
        );
    }
}

export default App;
