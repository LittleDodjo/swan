import axios from "axios";

class CookieProvider{

    constructor() {

    }

    readLocal(key){

    }

    readSession(key){
        return sessionStorage.getItem(key);
    }

    writeLocal(key, value){

    }

    writeSession(key, value){
        return sessionStorage.setItem(key, value);
    }
}

export default CookieProvider;