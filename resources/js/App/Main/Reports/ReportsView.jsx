import React, {Component} from 'react';
import Header from "../../Common/Components/Header";

class ReportsView extends Component {
    render() {
        return (
            <>
                <Header heading={<p className="text-2xl font-light">Отчеты</p>}/>
            </>
        );
    }
}

export default ReportsView;
