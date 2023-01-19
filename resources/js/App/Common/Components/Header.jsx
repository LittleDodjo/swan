import React, {Component} from 'react';

class Header extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="bg-white border-b flex">
                <div className="flex w-full m-4">
                    {this.props.heading}
                </div>
                <div className="flex">
                    {this.props.children}
                </div>
            </div>
        );
    }
}

export default Header;
