import React, {Component} from 'react';

class MarksTableHeader extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="flex divide-x">
                {this.props.data.map((value, key) => (
                    value === '*' ?
                        <p className="basis-1/6 cursor-pointer bg-gray-50 p-2 font-light hover:text-indigo-500 text-center"
                           key={key}>id</p>
                        :
                        <p className="w-full cursor-pointer bg-gray-50 p-2 font-light hover:text-indigo-500 text-center"
                           key={key}>{value}</p>
                ))}
            </div>
        );
    }

}

export default MarksTableHeader;
