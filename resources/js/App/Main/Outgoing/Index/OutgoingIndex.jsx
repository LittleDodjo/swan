import React, {Component} from 'react'
import ButtonRounded from "../../../Common/Components/ButtonRounded";
import Plus24 from "../../../Common/Resources/Plus24";
import SearchRounded from "../../../Common/Components/SearchRounded";
import Table from "../../../Common/Components/Table";
import OutgoingTableBody from "../Components/OutgoingTableBody";
import CookieProvider from "../../../Providers/CookieProvider";
import OutgoingProvider from "../../../Providers/OutgoingProvider";
import toast from "react-hot-toast";
import SplashLoader from "../../../AppLogin/Components/SplashLoader";
import InfiniteScroll from "react-infinite-scroll-component";
import Bookmark24 from "../../../Common/Resources/Bookmark24";
import Build24 from "../../../Common/Resources/Build24";
import Archive24 from "../../../Common/Resources/Archive24";
import withRouter from "../../../withRouter";

class OutgoingIndex extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loaded: false,
            fails: false,
            data: [],
            page: 1,
            total: 1,
            search: '',
            table: ['*', 'Тип отправления', 'Адресат', 'Марки', 'Регистрационный номер', 'Дата регистрации', 'Исполнитель'],
        }

        this.fetchData = this.fetchData.bind(this);
    }

    fetchData() {
        const current = this.state.page;
        if (current + 1 <= this.state.total) {
            this.setState({page: current + 1})
            OutgoingProvider.index(current + 1, (res) => {
                if (res.status === 200) {
                    const data = this.state.data;
                    this.setState({[data]: data.push(...res.data.data)});
                } else {
                    toast.error("Что-то пошло не так");
                }
            });
        }
        return;
    }

    componentDidMount() {
        if (!CookieProvider.issetSession('outgoing')) {
            OutgoingProvider.index(this.state.page, (res) => {
                if (res.status === 200) {
                    this.setState({total: res.data.total, loaded: true, data: res.data.data});
                    CookieProvider.writeSession('outgoing', res.data.data);
                    CookieProvider.writeSession('outgoingTotal', res.data.total);
                } else {
                    toast.error("Не получилось загрузить данные, возможно у вас нет прав на просмотр раздела");
                    this.setState({fails: true});
                }
            });
        } else {
            this.setState({
                loaded: true,
                data: CookieProvider.readSession('outgoing'),
                total: CookieProvider.readSession('outgoingTotal'),
            });
        }
    }

    render() {
        if (this.state.fails) return <p className="text-xl mx-auto my-auto">Ошибка загрузки</p>;
        return (
            <>
                <div className="flex justify-between">
                    <h1 className="text-3xl m-4">Исходящие документы</h1>
                    <div className="flex">
                        <ButtonRounded caption="Архив" svg={<Archive24/>} class={"rounded-button-secondary"}/>
                        <ButtonRounded caption="Организации" svg={<Build24/>} class={"rounded-button-secondary"}/>
                        <ButtonRounded caption="Марки" svg={<Bookmark24/>} class={"rounded-button-secondary"}
                                       action={() => this.props.navigate('/app/marks/')}
                        />
                    </div>
                </div>
                <div className="flex m-2">
                    <ButtonRounded caption="Создать новый" svg={<Plus24/>}
                                   action={() => this.props.navigate('/app/create/outgoing')}
                    />
                    <SearchRounded placeholder={"Поиск документа"} class="w-full mr-2" action={(e) => this.setState(e)}/>
                </div>
                {this.state.loaded ?
                    <div className="flex flex-col mx-4 mb-4">
                        <InfiniteScroll next={this.fetchData} hasMore={this.state.page < this.state.total}
                                        loader={<>Идет загрузка</>} scrollableTarget="ref"
                                        endMessage={<p className="italic text-gray-600 text-center font-light">
                                            Больше нет данных</p>}
                                        dataLength={this.state.data.length}>
                            <Table head={this.state.table}>
                                <OutgoingTableBody data={this.state.data} search={this.state.search}/>
                            </Table>
                        </InfiniteScroll>
                    </div>
                    : <SplashLoader/>}
            </>
        );
    }
}

export default withRouter(OutgoingIndex);
