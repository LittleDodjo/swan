import React, {Component} from 'react';
import HeadingButton from "../../../Common/Components/HeadingButton";
import Header from "../../../Common/Components/Header";
import Edit24 from "../../../Common/Resources/Edit24";
import Delete24 from "../../../Common/Resources/Delete24";
import withRouter from "../../../withRouter";
import OutgoingBack from "./OutgoingBack";

class OutgoingDocumentHeader extends Component {


    constructor(props) {
        super(props);
    }

    render() {
        return (
            <Header heading={<OutgoingBack caption="Просмотр исходящего документа №" id={this.props.id}/>}>
                <HeadingButton svg={<Edit24/>} text="Редактировать"
                               action={() => this.props.navigate('/app/create/outgoing')}/>
                <HeadingButton svg={<Delete24/>} text="Удалить" action={this.props.filter}/>
            </Header>
        );
    }
}

export default withRouter(OutgoingDocumentHeader);
