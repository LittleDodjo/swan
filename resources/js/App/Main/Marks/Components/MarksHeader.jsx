import React, {Component} from 'react';
import AssignBalance from "./AssignBalance";
import StampCreate from "./StampCreate";
import ArrowLeft24 from "../../../Common/Resources/ArrowLeft24";
import ButtonRounded from "../../../Common/Components/ButtonRounded";

class MarksHeader extends Component {

    constructor(props) {
        super(props);
        this.state = {
            stampsWindow: false,
            stampCreate: false,
        };

        this.stampsWindow = this.stampsWindow.bind(this);
        this.stampCreate = this.stampCreate.bind(this);
    }

    stampsWindow(state) {
        this.setState({stampsWindow: state});
    }

    stampCreate(state){
        this.setState({stampCreate: state});
    }

    render() {
        const last = this.props.last;
        return (
            <>
                    <div className="flex mx-10 justify-between">
                        <div className="flex">
                            <ArrowLeft24 link="/app/outgoing"/>
                            <h1 className="text-3xl my-4">Почтовые марки</h1>
                        </div>
                        <div className="flex">
                            <ButtonRounded caption="Создать отчет" action={() => console.log("test")}/>
                            <ButtonRounded caption="Начислить" action={() => this.stampsWindow(true)} class="rounded-button-secondary"/>
                            <ButtonRounded caption="Создать номинал" action={() => this.stampCreate(true)} class="rounded-button-secondary"/>
                        </div>
                    </div>
                <div className="flex h-full flex-col">
                    {this.props.children}
                </div>
                <AssignBalance state={this.state.stampsWindow} action={this.stampsWindow}/>
                <StampCreate state={this.state.stampCreate} action={this.stampCreate}/>
            </>
        );
    }
}

export default MarksHeader;
