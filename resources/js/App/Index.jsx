import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import axios from "axios";

axios.defaults.baseURL = "http://127.0.0.1:8000/";
axios.defaults.headers.post["Content-Type"] = "application/json";

axios.interceptors.request.use(request => {
    console.log(request);
    // Edit request config
    return request;
}, error => {
    console.log(error);
    return Promise.reject(error);
});

axios.interceptors.response.use(response => {
    console.log(response);
    // Edit response config
    return response;
}, error => {
    console.log(error);
    return Promise.reject(error);
});

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
