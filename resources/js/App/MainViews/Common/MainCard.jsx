import React, {Component} from 'react';

class MainCard extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <div className="flex w-full justify-center">
                <div className="form-card">
                    <div className="flex flex-col justify-center p-4">
                        {this.props.children}
                    </div>
                </div>
            </div>
        );
    }
}

export default MainCard;
