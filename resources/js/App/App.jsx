import React, {Component} from 'react';
import {Toaster} from 'react-hot-toast';
import {BrowserRouter} from 'react-router-dom';
import AuthView from "./AppLogin/AuthView";
import AppServiceProvider from "./Providers/AppServiceProvider";
import AppRoutes from "./AppRoutes";

class App extends Component {

    constructor(props) {
        super(props);
        this.state = {
            authState: false,
            maxTokenTime: 700,
            lastRefresh: 0,
            refreshTokenInterval: null,
        };

        this.authAction = this.authAction.bind(this);
        this.refreshAction = this.refreshAction.bind(this);
        this.resetAuth = this.resetAuth.bind(this);
        this.tokenTime = this.tokenTime.bind(this);
    }


    authAction(data) {
        if (data.code === 200) {
            this.setState({authState: true});
        } else {
            sessionStorage.removeItem('authorization');
            this.setState({authState: false});
        }
    }

    refreshAction(data) {
        if (data.code === 200) {
            this.setState({authState: true});
            const appProvider = new AppServiceProvider();
            appProvider.saveRefresh(data.authorization);
        } else {
            sessionStorage.removeItem('authorization');
            this.setState({authState: false});
        }
    }

    resetAuth() {
        this.setState({
            lastRefresh: 0,
            authState: false,
        });
    }

    tokenTime() {
        this.setState((prevState) => ({
            lastRefresh: prevState.lastRefresh + 1
        }));
    }

    componentDidMount() {
        const appProvider = new AppServiceProvider();
        appProvider.checkAuth(this.refreshAction);
        if (this.state.authState === false) return;
        const interval = setInterval(() => {
            if (sessionStorage.getItem("authorization") === null) this.resetAuth();
            if (this.state.lastRefresh >= this.state.maxTokenTime) {
                appProvider.checkAuth(this.refreshAction);
                this.setState({lastRefresh: 0});
            }
            this.tokenTime();
        }, 1000);
        this.setState({refreshTokenInterval: interval});
    }

    render() {
        return (
            <>
                <Toaster position="bottom-right"/>
                <BrowserRouter>
                    <AppRoutes authState={this.state.authState}>
                        <AuthView action={this.authAction}/>
                    </AppRoutes>
                </BrowserRouter>
            </>
        );
    }
}

export default App;
