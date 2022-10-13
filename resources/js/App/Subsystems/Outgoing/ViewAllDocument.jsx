import React, {Component} from 'react';
import SubsystemCaption from "../Common/SubsystemCaption";
import Loader from "../Common/Loader";
import OutgoingProvider from "../SubsystemProvider/OutgoingProvider";
import {toast} from "react-toastify";

class ViewAllDocument extends Component {

    constructor(props) {
        super(props);
        this.state = {
            provider: new OutgoingProvider(),
            pageId: 1,
            isLoaded: false,
            tableConfig: [
                "№", "Исполнитель", "Отдел", "№ Исходящий", "Содержание письма",
                "Дата отправки", "Количество конвертов", "Тип конверта",
            ],
            tableBodyFileds: [
                "id", "executor_id", "department_id", "outgoing_number", "document_content",
                "departure_date", "count_of_envelopes", "envelope_type",
            ],
            loadedData: []
        }

        this.loadData = this.loadData.bind(this);
    }


    loadData(data) {
        if (data.status === 200) {
            toast.success("Данные успешно загружены", {autoClose : 300 });
            this.setState({loadedData: data, isLoaded: true});
        } else
            toast.error("Ошибка загрузки данных", {autoClose : 1000 });
    }


    componentDidMount() {
        if (!this.state.isLoaded) {
            const viewAll = this.state.provider;
            viewAll.viewAllDocuments(this.state.pageId, this.loadData);
        }
    }


    render() {
        const tHead = this.state.tableConfig;
        const tableData = this.state.loadedData.data
        console.log(this.state.loadedData.data);
        return (
            <>
                <SubsystemCaption caption="Карточки исходящих документов"/>
                {this.state.isLoaded ? <>
                    <div className="flex w-full flex-col">
                        <table className="mx-4 shadow-md">
                            <thead className="border-b border-t bg-white">
                            <tr>
                                {tHead.map((data, key) => (
                                    <th className="border-r" key={key}>{data}</th>
                                ))}
                            </tr>
                            </thead>
                            <tbody className="bg-gray-50 cursor-pointer text-center">
                            {tableData.map((data, key) => (
                                <tr key={key} className="border-b hover:text-indigo-500 hover:bg-slate-100">
                                    <td className="border-r">{data.id}</td>
                                    <td className="border-r">{data.executor_id}</td>
                                    <td className="border-r">{data.department_id}</td>
                                    <td className="border-r">{data.outgoing_number}</td>
                                    <td className="border-r">{data.document_content}</td>
                                    <td className="border-r">{data.departure_date}</td>
                                    <td className="border-r">{data.count_of_envelopes}</td>
                                    <td className="border-r">{data.envelope_type}</td>
                                </tr>
                            ))}
                            </tbody>
                        </table>
                    </div>

                </> : <Loader/>}
            </>
        );
    }
}

export default ViewAllDocument;
