import React, {Component} from 'react';
import { Toaster } from 'react-hot-toast';
import {BrowserRouter, Navigate, Route, Routes} from 'react-router-dom';
import AuthView from "./Main/AuthView";
import Test from "./Services/test";
import AppServiceProvider from "./Providers/AppServiceProvider";

class App extends Component {

    constructor(props) {
        super(props);
        this.state = {
            authState: false,
            maxTokenTime: 700,
            lastRefresh: 0,
        };

        this.authAction = this.authAction.bind(this);
    }

    authAction(result){
        this.setState({authState: result});
    }

    componentDidMount() {
        const appProvider = new AppServiceProvider();
        appProvider.checkAuth(this.authAction);
        const interval = setInterval(() => {
            const maxTokenTime = this.state.maxTokenTime;
            if (this.state.authState === false) return;
            if (this.state.lastRefreshToken >= maxTokenTime) {
                appProvider.checkAuth(this.authAction);
                this.setState({lastRefreshToken: 0});
            }
            this.setState((prevState) => ({
                lastRefreshToken: prevState.lastRefreshToken + 1
            }));
        }, 1000);
        this.setState({refreshTokenInterval: interval});
    }

    render() {
        return (
            <>
                <Toaster position="bottom-right"/>
                <BrowserRouter>
                    <Routes>
                        <Route exact path='/' element={
                            this.state.authState ? <Navigate to="/app"/> : <AuthView action={this.authAction}/>
                        }/>
                        <Route exact path="/app" element={
                            this.state.authState ? <Test/> : <Navigate to="/"/>
                        }/>
                    </Routes>
                </BrowserRouter>
            </>
        );
    }
}

export default App;
