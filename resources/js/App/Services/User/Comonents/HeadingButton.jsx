import React, {Component} from 'react';

class HeadingButton extends Component {

    constructor(props) {
        super(props);
    }

    render() {

        return (
            <div className="svg-button-top" onClick={this.props.action}>
                <div className="my-auto mr-4">
                    {this.props.svg}
                </div>
                <div className="my-auto mr-4">
                    <p>
                        {this.props.text}
                    </p>
                </div>
            </div>
        );
    }
}

export default HeadingButton;
