import React, {Component} from 'react';
import Header from "../../Common/Components/Header";

class MarksView extends Component {
    render() {
        return (
            <>
                <Header heading={<p className="text-2xl font-light">Реестр марок</p>}/>
            </>
        );
    }
}

export default MarksView;