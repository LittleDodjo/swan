import React, {Component} from 'react';

class UserNotFound extends Component {
    render() {
        return (
            <div className="border border-indigo-500 bg-white m-4 p-4 flex flex-col">
                <div className="text-xl border-b">
                    <p>Ошибка</p>
                </div>
                <div className="border-b">
                    <p className="my-2">
                        Пользователель с таким идентификатором ({this.props.id}) не найден.
                    </p>
                </div>
                <div className="flex mt-4">
                    <p className="bg-slate-100 p-2 cursor-pointer hover:text-white hover:bg-indigo-500 rounded">Выйти</p>
                </div>
            </div>
        );
    }
}

export default UserNotFound;
