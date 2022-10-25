import React, {Component} from 'react';
import TableHead from "./TableHead";
import TableBody from "./TableBody";

class Table extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="flex w-full flex-col">
                <table className="mx-4 shadow-md cursor-pointer">
                    <TableHead tHead={this.props.tHead}/>
                    <TableBody tableData={this.props.tableData} filter={this.props.filter} action={this.props.action}/>
                </table>
            </div>
        );
    }
}

export default Table;
