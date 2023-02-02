import React, {Component} from 'react';

class MarksHistory extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="mx-10 my-4 flex flex-col rounded-xl border bg-white shadow-lg">
                <h1 className="p-4 text-xl font-light">История использования марок</h1>
                <div className="flex flex-col divide-y border-y">
                    {this.props.children}
                </div>
            </div>
        );
    }
}

export default MarksHistory;
