import React, {Component} from 'react';

class OutgoingTable extends Component {
    render() {
        return (
            <div className="flex flex-col">
                <div className="flex flex-col divide-y bg-white shadow-md">
                    {this.props.children}
                </div>
            </div>
        );
    }
}

export default OutgoingTable;
