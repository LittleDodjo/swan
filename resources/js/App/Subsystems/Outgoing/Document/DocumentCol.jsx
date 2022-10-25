import React, {Component} from 'react';

class DocumentCol extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="w-full">
                <h1 className="text-sm text-slate-400">{this.props.caption}</h1>
                {this.props.value === 0 || this.props.value === null ?
                    <p className="font-light text-slate-400">(Не заполнено)</p> :
                    <p className="font-light">{this.props.value}</p>
                }

            </div>
        );
    }
}

export default DocumentCol;
