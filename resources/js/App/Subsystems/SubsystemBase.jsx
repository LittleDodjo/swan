import React, {Component} from 'react';
import Sidebar from './Sidebar/Sidebar';
import MainSubsystem from "./MainSubsystem/MainSubsystem";
import OutgoingDocument from "./OutgoingDocument/OutgoingDocument";
import OutgoingBase from "./OutgoingDocument/OutgoingBase";

class SubsystemBase extends Component {

    constructor(props) {
        super(props);
        this.state = {
            subsystemId: 1,
            subsystem : {
                0 : <MainSubsystem/>,
                1 : <OutgoingBase/>
            }
        }

        this.selectSubsystem = this.selectSubsystem.bind(this);
    }

    selectSubsystem(page){
        this.setState({subsystemId: page});
        console.log(page);
    }

    render() {
        return (
            <div className="flex h-screen w-screen flex-row overflow-hidden bg-slate-100">
                <Sidebar menuRef={this.selectSubsystem}/>
                {this.state.subsystem[this.state.subsystemId]}
            </div>
        );
    }
}

export default SubsystemBase;
