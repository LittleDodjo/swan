import React, {Component} from 'react';
import SplashScreen from "../../../Common/Components/SplashScreen";
import OrganizationProvider from "../../../Providers/OrganizationProvider";
import toast from "react-hot-toast";
import SplashLoader from "../../../AppLogin/Components/SplashLoader";

class OutgoingOrganization extends Component {

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
    }

    handleChange(event) {
        this.setState({query: event.target.value});
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
            <SplashScreen state={this.props.state} action={this.props.action} caption="Реестр организаций">
                {this.state.loaded ?
                    <div className="grid grid-cols-3 h-fit overflow-y-auto">
                        <div className="col-span-3 bg-slate-100 m-4 border-b border-gray-300">
                            <input type="text" placeholder="Найти организацию" onChange={this.handleChange}
                                   value={this.state.query} name="query"
                                   className="w-full h-full focus:ring-0 border-none px-2"/>
                        </div>
                        {this.search().map((value, key) => (
                            <div className="border border-gray-300 p-4 m-4 col-span-3 hover:bg-slate-100 cursor-pointer" key={key} onClick={() => {
                                this.props.select(value.id);
                                this.props.action(false);
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

export default OutgoingOrganization;
