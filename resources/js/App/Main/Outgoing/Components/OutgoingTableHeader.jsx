import React, {Component} from 'react';

class OutgoingTableHeader extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="flex divide-x">
                {this.props.table.map((value, key) =>
                    value === '*' ?
                        <div key={key} className="basis-1/6 p-2 text-center cursor-pointer hover:bg-gray-50">id</div> :
                        <div key={key} className="table-top">{value}</div>
                )}

            </div>
        );
    }
}

export default OutgoingTableHeader;
