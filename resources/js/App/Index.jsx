import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import axios from "axios";

axios.defaults.baseURL = "http://127.0.0.1:8000/";
axios.defaults.headers.post["Content-Type"] = "application/json";
axios.defaults.headers.get['Content-Type'] = 'application/json';
axios.defaults.headers.patch['Content-Type'] = 'application/json';
axios.defaults.headers.delete['Content-Type'] = 'application/json';


axios.interceptors.request.use(async request => {
    const Authorization = JSON.parse(sessionStorage.getItem("authorization"));
    request.headers = {
        Accept: 'application/json',
        "Content-Type":
            "application/json",
        Authorization: Authorization
    }
    // console.log(request);
    return request;
}, error => {
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
    ReactDOM.render(<App/>, document.getElementById('app'));
}
