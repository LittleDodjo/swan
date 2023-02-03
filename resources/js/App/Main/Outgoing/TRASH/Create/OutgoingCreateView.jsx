import React, {Component} from 'react';
import Header from "../../../../Common/Components/Header";
import OutgoingBack from "../Components/OutgoingBack";
import OutgoingCreateBody from "./OutgoingCreateBody";
import HeadingButton from "../../../../Common/Components/HeadingButton";
import Save24 from "../../../../Common/Resources/Save24";
import withRouter from "../../../../withRouter";
import SplashLoader from "../../../../AppLogin/Components/SplashLoader";
import OutgoingProvider from "../../../../Providers/OutgoingProvider";
import toast from "react-hot-toast";
import CookieProvider from "../../../../Providers/CookieProvider";

class OutgoingCreateView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            saving: false,
            outgoingDocument: {
                envelopes_count: 1,
                lists_count: 1,
                message_type: 1,
                registration_number: "",
                registration_date: null,
                departure_data: [],
                stamps_used: [],
                executor_id: null,
            }
        };

        this.updateState = this.updateState.bind(this);
        this.save = this.save.bind(this);
    }

    save(data) {
        OutgoingProvider.store(data, (response) => {
            if(response.status === 200){
                toast.success("Документ успешно сохранен!");
                CookieProvider.removeSession('outgoing');
                this.props.navigate('/app/outgoing/');
            }else {
                toast.error("Ошибка сохранения!");
            }
        });
    }

    updateState(key, value) {
        const content = this.state.outgoingDocument;
        content[key] = value;
        this.setState({outgoingDocument: content});
    }

    render() {
        return (
            <>
                {this.state.saving ? <SplashLoader/> :
                    <div className="body-view">
                        <Header heading={<OutgoingBack caption="Создание исходящего документа"/>}>
                            <HeadingButton svg={<Save24/>} text="Сохранить" action={() => this.save(this.state.outgoingDocument)}/>
                        </Header>
                        <OutgoingCreateBody action={this.updateState} {...this.state.outgoingDocument}/>
                    </div>
                }
            </>
        );
    }

}

export default withRouter(OutgoingCreateView);
