import React, {Component} from 'react';

class SearchRounded extends Component {

    constructor(props) {
        super(props);
        this.state = {};
        this.handleChange = this.handleChange.bind(this);
    };


    handleChange(e) {
        this.setState({[e.target.name]: e.target.value});
        this.props.action({[e.target.name]: e.target.value});
    }

    render() {
        return (
            <>
                <input type="text" placeholder={this.props.placeholder} onChange={this.handleChange}
                       className={`rounded-lg basis-10/12 py-0 px-4 shadow-lg ${this.props.class}`} name={this.props.name}/>
            </>
        );
    }
}

SearchRounded.defaultProps = {
    name: "search",
    placeholder: "Поиск",
}

export default SearchRounded;
