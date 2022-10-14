import React, {Component} from 'react';

class FormBase extends Component {
    render() {
        return (
            <div className="classic-form">
                {this.props.children}
            </div>
        );
    }
}

export default FormBase;
