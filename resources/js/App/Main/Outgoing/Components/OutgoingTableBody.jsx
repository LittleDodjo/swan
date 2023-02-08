import React, {Component} from 'react';
import withRouter from "../../../withRouter";
import OutgoingProvider from "../../../Providers/OutgoingProvider";

class OutgoingTableBody extends Component {

    constructor(props) {
        super(props);
        this.state = {};

        this.search = this.search.bind(this);
    }

    search(){
        const Data = this.props.data;
        const query = this.props.search;
        return Data.filter(card => {
            if (query === '') {
                return card;
            } else if (
                card.registrationDate.toLocaleLowerCase().includes(query.toLocaleLowerCase()) ||
                card.registrationNumber.toLocaleLowerCase().includes(query.toLocaleLowerCase()) ||
                card.executor.toLocaleLowerCase().includes(query.toLocaleLowerCase())
            ) {
                return card;
            }
        });
    }




    render() {
        return (
            this.search().map((value, key) =>
                <tr key={key} onClick={() => this.props.navigate(`/app/outgoing/${value.id}`)}>
                    <td>{value.id}</td>
                    <td>{!value.messageType ? "Заказное" : "Простое"}</td>
                    <td>{OutgoingProvider.GetDepartureType(value.departureType)}</td>
                    <td>{value.stamps} шт.</td>
                    <td>{value.registrationNumber}</td>
                    <td>{value.registrationDate}</td>
                    <td>{value.executor}</td>
                </tr>
            ));
    }
}

export default withRouter(OutgoingTableBody);
