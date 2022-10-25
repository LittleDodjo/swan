import React, {Component} from 'react';

class TableBody extends Component {

    constructor(props) {
        super(props);



    }


    render() {
        const tableData = this.props.tableData;
        const tableFilter = this.props.filter;
        return (
            <tbody className="bg-gray-50 cursor-pointer text-center">
            {tableData.map((data, key) => (
                <tr onClick={() => this.props.action(data)} key={key} className="border-b hover:bg-slate-100 hover:text-indigo-500 delay-75 transition-colors ease-in">

                    {Object.keys(data).map((key, index) => {
                        return (
                                tableFilter.includes(key) ?
                                    <td className="border-r" key={index}>{data[key]}</td> : null
                        );
                    })}
                </tr>
            ))}
            </tbody>
        );
    }
}

export default TableBody;
