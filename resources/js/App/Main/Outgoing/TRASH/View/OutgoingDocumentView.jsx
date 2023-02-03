import React, {Component} from 'react';
import withRouter from "../../../../withRouter";
import OutgoingDocumentHeader from "./OutgoingDocumentHeader";
import SplashLoader from "../../../../AppLogin/Components/SplashLoader";
import CookieProvider from "../../../../Providers/CookieProvider";
import OutgoingProvider from "../../../../Providers/OutgoingProvider";
import toast from "react-hot-toast";
import OutgoingDocumentBody from "./OutgoingDocumentBody";

class OutgoingDocumentView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loaded: false,
            data: null
        };
    }

    componentDidMount() {
        if (!CookieProvider.issetSession('outgoing.'+this.props.params.id)){
            OutgoingProvider.show(this.props.params.id, (res) => {
                if(res.status === 200) {
                    this.setState({loaded: true, data: res.data});
                    CookieProvider.writeSession('outgoing.'+this.props.params.id, JSON.stringify(res.data));
                }else{
                    toast.error("Ошибка загрузки ("+ res.status+")");
                }
            })
        }else{
            this.setState({
                loaded: true,
                data: JSON.parse(CookieProvider.readSession('outgoing.'+this.props.params.id,))
            });
        }
    }

    render() {
        return (
            <>
                <OutgoingDocumentHeader id={this.props.params.id}/>
                {this.state.loaded ?
                    <OutgoingDocumentBody data={this.state.data}/>
                    : <SplashLoader/>}
            </>
        );
    }
}

export default withRouter(OutgoingDocumentView);
