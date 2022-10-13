import axios from "axios";
import SubsystemHelper from "./SubsystemHelper";
import subsystemHelper from "./SubsystemHelper";

class OutgoingProvider{

    baseUrl = "../api/subsystem/outgoing/";

    provider = null;

    helper = null;

    constructor() {
        this.helper = new subsystemHelper();
        const token = this.helper.getUserToken();
        this.provider = axios.create({
            headers:{
                "Content-Type" : "application/json",
                "Accept": "application/json",
                "Authorization": token,
            }
        });
    }

    viewAllDocuments(pageId, func){
        const provider = this.provider;
        provider.get(this.baseUrl + "documents").then((res) => {
            const data = {
                status: 200,
                data : res.data[0].data,
                meta: res.data[0].meta
            };
            func(data);
        }).catch((e) => {
            const data = {
                // status : e.response.status,
            };
            console.log(e);
            func(e);
        });
    }

    viewDocument(){}

    createDocument(){}

    deleteDocument(){}

}

export default OutgoingProvider;
