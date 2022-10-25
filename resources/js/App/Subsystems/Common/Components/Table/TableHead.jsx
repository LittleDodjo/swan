import React, {Component} from 'react';

class TableHead extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        const tHead = this.props.tHead;
        return (
            <thead className="border-b border-t bg-white">
            <tr>
                {tHead.map((data, key) => (
                    <th className="border-r" key={key}>{data}</th>
                ))}
            </tr>
            </thead>
        );
    }
}

export default TableHead;