import axios, {Axios} from "axios";
import UserProvider from "./UserProvider";

class OutgoingProvider{

    baseUrl = "api/subsystem/outgoing/";

    outgoingProvider = null;

    constructor() {
        const userProvider = new UserProvider();
        const token = userProvider.getToken();
        this.outgoingProvider = axios.create({
            headers: {
                Content: "application/json",
                Authorization: (token !== null) ? token.type + " " + token.token : "",
            }
        });
    }

    getAll(func){
        const provider = this.outgoingProvider;
        provider.post(this.baseUrl+"documents").then((res) => {
            func(res.data[0]);
        }).catch((e) => {

        });
    }
}

export default OutgoingProvider;