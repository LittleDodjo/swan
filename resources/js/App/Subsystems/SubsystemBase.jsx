import React, {Component} from 'react';

class SubsystemBase extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="flex h-screen w-screen flex-row overflow-hidden bg-slate-100">
                {this.props.children}
            </div>
        );
    }
}

export default SubsystemBase;
