import React, {Component} from 'react';

class TableComponent extends Component {

    constructor(props) {
        super(props);

    }

    componentDidMount() {

    }

    render() {
        const thead = this.props.tHead;
        const tbody = this.props.tBody.data;
        console.log(tbody);
        return (
            <div className="bg-red-300 mx-4">
                <table className="rounded-lg border w-full">
                    <thead className="">
                    <tr>
                        {thead.map((data, key) =>
                            <th key={key}>{data}</th>
                        )}
                    </tr>
                    </thead>
                    <tbody>
                    {tbody.map((data, key) =>
                        <tr key={key}>
                            {Object.keys(data).map((key, i) =>
                                <td key={i}>{data[key]}</td>
                            )}
                        </tr>
                    )}
                    </tbody>
                </table>
            </div>
        );
    }
}

export default TableComponent;