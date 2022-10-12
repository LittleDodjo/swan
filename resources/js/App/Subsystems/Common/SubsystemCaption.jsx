import React, {Component} from 'react';

class SubsystemCaption extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="mx-4 my-4 flex">
                <h1 className="text-2xl font-light">{this.props.caption}</h1>
                {/*<p className="my-auto mx-4 text-2xl underline underline-offset-4 font-light text-indigo-500">4</p>*/}
            </div>
        );
    }
}

export default SubsystemCaption;
