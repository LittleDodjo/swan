import axios from "axios";

class CookieProvider{

    constructor() {

    }

    readLocal(key){
        return localStorage.getItem(key);
    }

    readSession(key){
        return sessionStorage.getItem(key);
    }

    writeLocal(key, value){
        return localStorage.setItem(key, value);
    }

    writeSession(key, value){
        return sessionStorage.setItem(key, value);
    }

    issetSession(key){
        const session = this.readSession(key);
        return (session !== null && session !=="");
    }

    issetLocal(key){
        const local = this.readLocal(key);
        return (local !== null && local !=="");
    }

    removeSession(key){
        sessionStorage.removeItem(key);
    };
}

export default CookieProvider;
