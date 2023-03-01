import React, {Component} from 'react';
import withRouter from "../../withRouter";

class Fails extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        return (
            <p className="text-xl mx-auto my-auto">Ошибка загрузки
                <p onClick={() => this.props.navigate(this.props.link)}
                   className="hover:text-indigo-500 underline cursor-pointer">Вернуться</p>
            </p>);
    }
}

Fails.defaultProps = {
    link: "/app/outgoing",
}

export default withRouter(Fails);
