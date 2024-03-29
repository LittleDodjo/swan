import React, {Component} from 'react';
import toast from "react-hot-toast";
import withRouter from "../../withRouter";
import CookieProvider from "../../Providers/CookieProvider";
import StampProvider from "../../Providers/StampProvider";
import SplashLoader from "../../AppLogin/Components/SplashLoader";
import MarksTableHeader from "./Components/MarksTableHeader";
import MarksTableBody from "./Components/MarksTableBody";
import MarksHistory from "./Components/MarksHistory";
import MarksHeader from "./Components/MarksHeader";
import MarksStatistic from "./Components/MarksStatistic";

class MarksView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loaded: false,
            fails: false,
            table: ['*', 'Документ', 'Количество марок', 'Общая сумма', 'Дата', 'Тип'],
            history: {
                history: [],
                last: [],
            },
        };

    }

    componentDidMount() {
        if (!CookieProvider.issetSession('stampsHistory')) {
            StampProvider.history((response) => {
                if (response.status === 200) {
                    this.setState({history: response.data, loaded: true});
                    CookieProvider.writeSession('stampHistory', JSON.stringify(response.data));
                } else {
                    toast.error('Данные не загружены');
                    return;
                }
            });
        } else {
            this.setState({loaded: true, history: JSON.parse(CookieProvider.readSession('stampHistory'))});
        }
    }

    render() {
        const history = this.state.history.history;
        const last = this.state.history.last;
        return (
            this.state.loaded ?
                <div className="body-view " id="window">
                    <MarksHeader last={last}>
                        <MarksStatistic/>
                        <MarksHistory>
                            <MarksTableHeader data={this.state.table}/>
                            <MarksTableBody data={history}/>
                        </MarksHistory>
                    </MarksHeader>
                </div> : <SplashLoader/>
        );
    }
}

export default withRouter(MarksView);
