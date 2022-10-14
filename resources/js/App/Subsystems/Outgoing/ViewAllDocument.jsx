import React, {Component} from 'react';
import SubsystemCaption from "../Common/SubsystemCaption";
import Loader from "../Common/Loader";
import OutgoingProvider from "../SubsystemProvider/OutgoingProvider";
import {toast} from "react-toastify";
import Table from "../Common/Components/Table/Table";
import BaseButton from "../Common/Components/Inputs/BaseButton";
import FormBase from "../Common/FormBase";
import AddResource from "../Common/Resources/AddResource";
import SearchResource from "../Common/Resources/SearchResource";
import BaseInput from "../Common/Components/Inputs/BaseInput";

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

        this.openDocument = this.openDocument.bind(this);
        this.loadData = this.loadData.bind(this);
    }


    loadData(data) {
        if (data.status === 200) {
            toast.success("Данные успешно загружены", {autoClose: 300});
            this.setState({loadedData: data, isLoaded: true});
        } else {
            toast.error("Ошибка загрузки данных", {autoClose: 1000});
        }
    }

    openDocument(data) {
        this.props.openDocument(data);
    }


    componentDidMount() {
        if (!this.state.isLoaded) {
            const provider = this.state.provider;
            provider.viewAllDocuments(this.state.pageId, this.loadData);
        }
    }


    render() {
        const tHead = this.state.tableConfig;
        const tableData = this.state.loadedData.data;
        const tableFilter = this.state.tableBodyFileds;
        return (
            <>
                <SubsystemCaption caption="Карточки исходящих документов"/>
                <FormBase>
                    <BaseInput placeholder="Поиск"/>
                    <BaseButton value="Найти"/>
                    <BaseButton resource={<AddResource/>} value="Создать" action={this.props.createDocument}/>
                </FormBase>
                {this.state.isLoaded ?
                    <Table tHead={tHead} tableData={tableData} filter={tableFilter} action={this.openDocument}/> :
                    <Loader/>}
            </>
        );
    }
}

export default ViewAllDocument;
