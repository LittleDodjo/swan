import React, {Component} from 'react';
import OutgoingProvider from "../ServiceProvider/OutgoingProvider";
import TableComponent from "../Common/TableComponent";
import LoadingComponent from "../Common/LoadingComponent";
import ButtonComponent from "../Common/ButtonComponent";

class OutgoingView extends Component {

    constructor(props) {
        super(props);
        this.state = {
            provider: new OutgoingProvider(),
            isLoaded: false,
            table: [
                "№",
                "Дата отправления",
                "Дата регистрации исх. №",
                "Исходящий номер",
                "Тип конверта",
            ],
            data: {
                //... table
            }
        }

        this.setLoadedData = this.setLoadedData.bind(this);
    }

    setLoadedData(data) {
        this.setState({data: data, isLoaded: true});
    }

    componentDidMount() {
        const outgoingProvider = this.state.provider;
        outgoingProvider.getAll(this.setLoadedData);
    }

    render() {
        return (
            <main className="overflow-x-clip1 flex h-full w-full flex-col overflow-y-auto">


                <div className="mx-4 my-4 flex">
                    <h1 className="text-2xl font-light">Карточки исходящих документов</h1>
                    <p className="my-auto mx-4 text-2xl underline underline-offset-4 font-light text-indigo-500">4</p>
                </div>


                <div className="flex w-full flex-col">
                    {this.state.isLoaded ?
                        <div className="mx-4 flex flex-col">
                            <div className="my-4">
                                <ButtonComponent caption="Создать"/>
                            </div>
                            <TableComponent tHead={this.state.table} tBody={this.state.data}/>
                        </div> :
                        <LoadingComponent/>
                    }
                </div>
            </main>
        );
    }
}

export default OutgoingView;