import React, {Component} from 'react';

class DocumentRow extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        const isEnd = this.props.isEnd === true ? "" : "border-b";
        return (
            <div className={"mx-10 mb-2 flex justify-between py-2 " + isEnd}>
                {this.props.children}
            </div>
        );
    }
}

export default DocumentRow;
