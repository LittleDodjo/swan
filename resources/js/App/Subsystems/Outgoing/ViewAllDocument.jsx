import React, {Component} from 'react';
import SubsystemCaption from "../Common/SubsystemCaption";
import Loader from "../Common/Loader";
import OutgoingProvider from "../SubsystemProvider/OutgoingProvider";

class ViewAllDocument extends Component {

    constructor(props) {
        super(props);
        this.state = {
            provider: new OutgoingProvider(),
            pageId: 1,
            isLoaded: false,
            tableConfig: [
                "№", "Исполнитель", "Отдел", "№ Исходящий", "Содержание письма",
                "Дата отправки" ,"Количество конвертов", "Тип конверта",
            ]
        }

        this.loadData = this.loadData.bind(this);
    }


    loadData(data){
        console.log(data);
    }


    componentDidMount() {
        if(!this.state.isLoaded){
            const viewAll = this.state.provider;
            viewAll.viewAllDocuments(this.state.pageId, this.loadData);
        }
    }


    render() {
        return (
            <>
                <SubsystemCaption caption="Карточки исходящих документов"/>
                {this.state.isLoaded ? <></> : <Loader/>}
            </>
        );
    }
}

export default ViewAllDocument;
