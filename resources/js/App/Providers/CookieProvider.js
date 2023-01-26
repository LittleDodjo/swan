import axios from "axios";

class CookieProvider{

    constructor() {

    }

    static readLocal(key){
        return localStorage.getItem(key);
    }

    static readSession(key){
        return sessionStorage.getItem(key);
    }

    static writeLocal(key, value){
        return localStorage.setItem(key, value);
    }

    static writeSession(key, value){
        return sessionStorage.setItem(key, value);
    }

    static issetSession(key){
        const session = this.readSession(key);
        return (session !== null && session !=="");
    }

    static issetLocal(key){
        const local = this.readLocal(key);
        return (local !== null && local !=="");
    }

    static removeSession(key){
        sessionStorage.removeItem(key);
    };
}

export default CookieProvider;
