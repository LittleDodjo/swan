import React, {Component} from 'react';

class ButtonComponent extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="cursor-pointer w-fit shadow-md rounded-full hover:bg-indigo-500 hover:fill-indigo-500 hover:text-white px-4 py-2">
                <h1 className="">
                    {this.props.caption}
                </h1>
            </div>
        );
    }
}

export default ButtonComponent;