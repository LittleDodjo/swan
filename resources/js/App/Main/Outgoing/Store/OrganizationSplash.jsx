import React, {Component} from 'react';
import OrganizationProvider from "../../../Providers/OrganizationProvider";
import toast from "react-hot-toast";
import SplashScreen from "../../../Common/Components/SplashScreen";
import SplashLoader from "../../../AppLogin/Components/SplashLoader";

class OrganizationSplash extends Component {

    constructor(props) {
        super(props);
        this.state = {
            query: "",
            loaded: false,
            fails: false,
            organization: [],
        };

        this.handleChange = this.handleChange.bind(this);
        this.search = this.search.bind(this);
        this.loadData = this.loadData.bind(this);
        this.close = this.close.bind(this);
    }

    handleChange(event) {
        this.setState({query: event.target.value});
    }

    close(){
        this.props.action('organizationWindow');
    }

    search(){
        const Data = this.state.organization;
        const query = this.state.query;
        return Data.filter(card => {
            if (query === '') {
                return card;
            } else if (card.fullName.toLocaleLowerCase().includes(query.toLocaleLowerCase())) {
                return card;
            }
        });
    }

    loadData()
    {
        OrganizationProvider.index((data) => {
            if (data.status === 200) {
                this.setState({loaded: true, organization: data.data});
                return;
            } else {
                toast.error(`Ошибка загрузки данных ${data.status}`);
                this.setState({fails: true});
                return;
            }
        });
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        if(prevProps.state !== this.props.state){
            if(!this.state.loaded){
                this.loadData();
            }
        }
    }

    componentDidMount() {
        if(this.props.state){
            this.loadData();
        }
    }

    render() {
        if (this.state.fails) return <>Ошибка загрузки данных</>
        return (
            <SplashScreen state={this.props.state} action={this.close} caption="Реестр организаций">
                {this.state.loaded ?
                    <div className="flex flex-col h-fit overflow-y-auto">
                            <input type="text" placeholder="Найти организацию" onChange={this.handleChange}
                                   value={this.state.query} name="query"
                                   className="w-full h-full focus:ring-0 border-none px-2"/>
                        {this.search().map((value, key) => (
                            <div className="border border-gray-300 p-4 m-4 col-span-3 hover:bg-slate-100 cursor-pointer" key={key} onClick={() => {
                                this.props.select(value.id, value.fullName, 'organizationWindow');
                            }
                            }>
                                {value.fullName}
                            </div>
                        ))}
                    </div>
                    : <SplashLoader/>}
            </SplashScreen>
        );
    }
}

export default OrganizationSplash;
