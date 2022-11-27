import React, {Component} from 'react';

class LogoComponent extends Component {
    render() {
        return (
            <div className="mb-4 flex flex-col items-center">
                <img className="mb-4 h-32 w-32"
                     src="https://www.swanatmarbury.co.uk/sites/default/files/logos/Swan%20Logo.png" alt=""/>
                <h1 className="text-3xl font-light">Добро пожаловать в веб-интерфейс "Лебедь"</h1>
            </div>
        );
    }
}

export default LogoComponent;
