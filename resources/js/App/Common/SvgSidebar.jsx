import React, {Component} from 'react';

class SvgSidebar extends Component {

    constructor(props) {
        super(props);
        this.state = {
            id: 0,
        };

        this.handleClick = this.handleClick.bind(this);
    }

    handleClick(e){
        this.props.action(this.state.id);
    }

    componentDidMount() {
        this.setState({id : this.props.id});
    }

    render() {
        return (
            <li className="aside-btn" onClick={this.handleClick}>
                {this.props.svg}
            </li>
        );
    }
}

export default SvgSidebar;
