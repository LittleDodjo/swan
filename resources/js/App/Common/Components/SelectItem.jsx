import React, {Component} from 'react';

class SelectItem extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="border p-4 shadow-lg bg-red-200" onClick={() => {
                this.props.action(this.props.value);
            }}>{this.props.caption}</div>
        );
    }
}

export default SelectItem;
