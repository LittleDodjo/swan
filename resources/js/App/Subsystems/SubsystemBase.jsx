import React, {Component} from 'react';
import MainBase from "./Main/MainBase";
import OutgoingBase from "./Outgoing/OutgoingBase";
import Sidebar from "./Sidebar";

class SubsystemBase extends Component {

    constructor(props) {
        super(props);
        this.state = {
            appProvider : null,
            currentMenu : 1,
            menuConfig : {
                0 : <MainBase/>,
                1 : <OutgoingBase/>,
                2 : <>2</>,
                3 : <>3</>,
                4 : <>4</>,
                5 : <>5</>,
                6 : <>6</>,
            }
        }

        this.menuHandler = this.menuHandler.bind(this);
    }

    menuHandler(id){
        this.setState({currentMenu: id});
    }

    componentDidMount() {

    }

    render() {
        return (
            <div className="subsystem-base">
                <Sidebar menuHandler={this.menuHandler}/>
                <main className="main-subsystem-base">
                    {this.state.menuConfig[this.state.currentMenu]}
                </main>
            </div>
        );
    }
}

export default SubsystemBase;
