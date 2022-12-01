import React, {Component} from 'react';

class Copyright extends Component {
    render() {
        return (
            <div className="absolute bottom-0 w-screen text-center">
                <h1 className="text-sm font-light text-slate-400">Лицензия действует до 30.01.2023 года,
                    предоставлена Министерству социальных отношений Челябинской области.</h1>
                <p className="text-xs font-light text-slate-500">Данный веб-узел преодставляет возможность
                    пользоваться приложением электронного документооборота "Лебедь"</p>
            </div>
        );
    }
}

export default Copyright;
