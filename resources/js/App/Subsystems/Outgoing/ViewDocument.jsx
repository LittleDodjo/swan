import React, {Component} from 'react';
import DocumentCaption from "../Common/DocumentCaption";
import LinkButton from "../Common/Components/Inputs/LinkButton";
import DocumentRow from "./Document/DocumentRow";
import DocumentCol from "./Document/DocumentCol";
import Loader from "../Common/Loader";

class ViewDocument extends Component {

    constructor(props) {
        super(props);
        this.state = {
            current: null,
            fields: {
                executor_id: "Исполнитель",
                date_admission_to_office : "Дата поступления в канцелярию", //+
                department_id: "Номер отдела", // Номер отдела
                out_correspondent_id: "Номер исходящего корреспондента",  // Номер исходящего корреспондента
                out_correspondent_date: "Дата исходящего корреспондента", // Дата исходящего корреспондента
                document_type: "Тип документа", // Тип документа +
                departure_type: "Тип отправления", // Тип отправления +
                departure_view: "Вид отправления", // Вид отправления* +
                departure_date: "Дата отправления", //Дата отправления письма( физического конверта )
                departure_email_date: "Дата отправления электронной почтой", // Дата отправления электронной почтой +
                outgoing_number: "Исходящий номер", // Исходящий номер
                outgoing_date: "Дата регистрации исходящего номера",// Дата регистрации исходяшего номера
                lists_count: "Количество листов",// ККоличество листов
                where_directed: "Кому направлено", // Кому направлено (учреждение)
                recipient: "Получатель", // Получатель
                address: "Адрес доставки",  // Адрес доставки
                document_content: "Содержание документа", // Содержание документа
                count_of_instances: "Количество экземпляров", // Количество экземпляров
                count_of_envelopes: "Количество конвертов", //Количество конвертов
                envelope_type: "Тип конверта", // Тип конверта
                brand_price: "Стоимость марок" // Стоимость марок ( в рублевом эквиваленте )
            }
        }
    }


    componentDidMount() {
        this.setState({current: this.props.document});
    }

    render() {
        let caption = "";
        let current = null;
        if (this.state.current === null) {
            caption = "Создать исходящий документ";
        } else {
            caption = "Исходящий документ №" + this.state.current.id;
            current = this.state.current;
        }
        return (
            <>
                {current === null ? <Loader/> :
                    <div className="document-body">
                        <div className="document-header">
                            <DocumentCaption action={this.props.closeDocument} caption={caption}/>
                            <LinkButton caption="Редактировать"/>
                        </div>

                        <DocumentRow>
                            <DocumentCol caption={this.state.fields.departure_type} value={current.departure_type}/>
                            <DocumentCol caption={this.state.fields.document_type} value={current.document_type}/>
                            <DocumentCol caption={this.state.fields.departure_view} value={current.departure_view}/>
                        </DocumentRow>
                        <DocumentRow>
                            <DocumentCol caption={this.state.fields.date_admission_to_office} value="error"/>
                            <DocumentCol caption={this.state.fields.departure_date} value={current.departure_date}/>
                            <DocumentCol caption={this.state.fields.departure_email_date} value={current.departure_email_date}/>
                        </DocumentRow>
                        <DocumentRow>
                            <DocumentCol caption={this.state.fields.outgoing_number} value={current.outgoing_number}/>
                            <DocumentCol caption={this.state.fields.outgoing_date} value={current.outgoing_date}/>
                            <DocumentCol caption={this.state.fields.lists_count} value={current.lists_count}/>
                        </DocumentRow>
                        <DocumentRow>
                            <DocumentCol caption={this.state.fields.where_directed} value={current.where_directed}/>
                            <DocumentCol caption={this.state.fields.recipient} value={current.recipient}/>
                            <DocumentCol caption={this.state.fields.address} value={current.address}/>
                        </DocumentRow>
                        <DocumentRow>
                            <DocumentCol caption={this.state.fields.document_content} value={current.document_content}/>
                            <DocumentCol caption={this.state.fields.department_id} value={current.department_id}/>
                            <DocumentCol caption={this.state.fields.executor_id} value={current.executor_id}/>
                        </DocumentRow>
                        <DocumentRow>
                            <DocumentCol caption={this.state.fields.count_of_instances} value={current.count_of_instances}/>
                            <DocumentCol caption={this.state.fields.count_of_envelopes} value={current.count_of_envelopes}/>
                            <DocumentCol caption={this.state.fields.envelope_type} value={current.envelope_type}/>
                        </DocumentRow>
                        <DocumentRow isEnd={true}>
                            <DocumentCol caption={this.state.fields.out_correspondent_id} value={current.out_correspondent_id}/>
                            <DocumentCol caption={this.state.fields.out_correspondent_date} value={current.out_correspondent_date}/>
                            <DocumentCol caption={this.state.fields.brand_price} value={current.brand_price}/>
                        </DocumentRow>
                    </div>
                }
            </>
        );
    }
}

export default ViewDocument;
