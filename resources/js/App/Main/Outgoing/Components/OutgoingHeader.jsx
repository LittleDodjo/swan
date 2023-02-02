import React, {Component} from 'react';
import HeadingButton from "../../../Common/Components/HeadingButton";
import Plus24 from "../../../Common/Resources/Plus24";
import Filter24 from "../../../Common/Resources/Filter24";
import Archive24 from "../../../Common/Resources/Archive24";
import Header from "../../../Common/Components/Header";
import withRouter from "../../../withRouter";

class OutgoingHeader extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <Header heading={<p className="text-2xl font-light">Реестр исходящих документов</p>}>
                <HeadingButton svg={<Plus24/>} text="Создать новый"
                               action={() => this.props.navigate('/app/create/outgoing')}/>
                {/*<HeadingButton svg={<Filter24/>} text="Фильтр" action={this.props.filter}/>*/}
                {/*<HeadingButton svg={<Archive24/>} text="Архив" action={this.props.archive}/>*/}
            </Header>
        );
    }
}

export default withRouter(OutgoingHeader);
