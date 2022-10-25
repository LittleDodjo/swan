import React, {Component} from 'react';

class SidebarButton extends Component {

    constructor(props) {
        super(props);
        this.state = {
            id: 0,
        }

        this.handleClick = this.handleClick.bind(this);
    }

    handleClick(){
        this.props.action(this.state.id)
    }

    componentDidMount() {
        this.setState({id: this.props.id});
    }

    render() {
        return (
            <li className="aside-btn" onClick={this.handleClick}>
                {this.props.resource}
            </li>
        );
    }
}

export default SidebarButton;
