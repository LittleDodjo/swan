import React, {Component} from 'react';
import withRouter from "../../../withRouter";

class OutgoingTableBody extends Component {

    constructor(props) {
        super(props);
        this.state = {

        }
    }


    render() {
        if (this.props.data === null) {
            return (<>loading..</>);
        }
        return (
            this.props.data.map((value, key) =>
                <div className="table-body-item-line" key={key}
                     onClick={() => this.props.navigate("/app/outgoing/" + value.id)}>
                    <div className="basis-1/6 p-2 text-center">{value.id}</div>
                    <div
                        className="table-body-item">
                        {value.messageType ? "Заказной не маркированый" : "Простой, маркированый"}
                    </div>
                    <div className="table-body-item">3 Адресата</div>
                    <div className="table-body-item">5 марок</div>
                    <div className="table-body-item">{value.registrationNumber}</div>
                    <div className="table-body-item">{value.registrationDate}</div>
                    <div className="table-body-item">{value.executor}</div>
                </div>
            ));
    }
}

export default withRouter(OutgoingTableBody);
