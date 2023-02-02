import React, {Component} from 'react';
import OutgoingHeader from "../Components/OutgoingHeader";
import OutgoingArchive from "../OutgoingArchive";
import OutgoingFilter from "../OutgoingFilter";
import OutgoingTable from "./OutgoingTable";
import OutgoingTableHeader from "./OutgoingTableHeader";
import SplashLoader from "../../../AppLogin/Components/SplashLoader";
import OutgoingProvider from "../../../Providers/OutgoingProvider";
import OutgoingTableBody from "./OutgoingTableBody";
import CookieProvider from "../../../Providers/CookieProvider";
import toast from "react-hot-toast";
import InfiniteScroll from "react-infinite-scroll-component";

class OutgoingView extends Component {

    constructor(props) {
        super(props);

        this.state = {
            filter: false,
            archive: false,
            table: ['*', 'Тип отправления', 'Адресат', 'Марки', 'Регистрационный номер', 'Дата регистрации', 'Исполнитель'],
            loaded: false,
            page: 1,
            maxPage: 1,
        };

        this.filter = this.filter.bind(this);
        this.archive = this.archive.bind(this);
        this.fetchData = this.fetchData.bind(this);
    }

    filter(state) {
        this.setState({filter: state});
    }

    archive(state) {
        this.setState({archive: state});
    }

    fetchData() {

    }

    componentDidMount() {
        if (!CookieProvider.issetSession('outgoing')) {
            OutgoingProvider.index(this.state.page, (res) => {
                if (res.status === 200) {
                    this.setState({maxPage: res.total, loaded: true, data: res.data.data});
                    CookieProvider.writeSession('outgoing', JSON.stringify(res.data.data));
                } else {
                    toast.error("Не получилось загрузить данные, возможно у вас нет прав на просмотр раздела");
                }
            });
        } else {
            this.setState({loaded: true, data: JSON.parse(CookieProvider.readSession('outgoing'))});
        }
    }

    render() {
        return (
            <div className="relative flex h-full flex-col overflow-y-auto overflow-x-hidden">
                <OutgoingHeader archive={this.archive} filter={this.filter}/>
                <OutgoingArchive state={this.state.archive} action={this.archive}/>
                <OutgoingFilter state={this.state.filter} action={this.filter}/>
                {this.state.loaded ?
                    <OutgoingTable>
                        <OutgoingTableHeader table={this.state.table}/>
                        <OutgoingTableBody data={this.state.data}/>
                    </OutgoingTable> : <SplashLoader/>
                }
            </div>
        );
    }
}

export default OutgoingView;
