import React, {Component} from 'react';

class Error404 extends Component {
    render() {
        return (
            <div className="flex flex-col text-3xl font-bold text-center my-auto">
                <p className="">Ошибка 404</p>
                <p>Такая страница не найдена</p>
            </div>
        );
    }
}

export default Error404;
