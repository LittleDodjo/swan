import React, {Component} from 'react';

class MainBase extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="flex h-screen flex-col items-center justify-center bg-slate-100">
                {this.props.children}
            </div>
        );
    }
}

export default MainBase;
