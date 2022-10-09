import React, {Component} from 'react';
import {BrowserRouter} from 'react-router-dom';
import AuthProvider from './AppProvider/AuthProvider';
import AppRouter from "./AppRouter";

class App extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <BrowserRouter>
                <AppRouter />
            </BrowserRouter>
        );
    }
}

export default App;
