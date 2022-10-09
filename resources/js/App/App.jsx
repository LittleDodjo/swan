import React, {Component} from 'react';
import {BrowserRouter} from 'react-router-dom';
import AppRouter from "./AppRouter";

class App extends Component {

    constructor(props) {
        super(props);
    }

    componentDidMount() {

    }

    render() {
        return (
            <BrowserRouter>
                <AppRouter/>
            </BrowserRouter>
        );
    }
}

export default App;
