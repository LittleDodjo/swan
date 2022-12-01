import React, {Component} from 'react';

class MainView extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="relative flex h-screen w-screen flex-col bg-slate-100">
                {this.props.children}
            </div>
        );
    }
}

export default MainView;
