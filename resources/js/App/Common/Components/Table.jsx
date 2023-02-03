import React, {Component} from 'react';

class Table extends Component {

    constructor(props) {
        super(props);

        this.state = {}

    }


    render() {
        return (
            <div className="bg-white border rounded-lg">
                <table className="rounded-table">
                    <thead>
                    <tr>
                        {this.props.head.map((value, key) => (
                            <th key={key} className="rounded-table-th">
                                {value}
                            </th>
                        ))}
                    </tr>
                    </thead>
                    <tbody>
                    {this.props.children}
                    </tbody>
                </table>
            </div>
        );
    }
}

Table.defaultProps = {
    head: [
        'id', 'none'
    ],
    body: [
        'false', 'false',
    ],
    children: 'none',
};

export default Table;
