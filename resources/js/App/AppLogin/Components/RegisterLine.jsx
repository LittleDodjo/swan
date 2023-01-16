import React, {Component} from 'react';

class RegisterLine extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        if (this.props.active === "1") { //Активное окно
            var className = "border-white";
        } else if (this.props.active === "3") { // Не пройденое окно
            var className = "border-white";
        } else { //Уже пройденое окно
            var className = "border-indigo-600";
        }
        return (
            <div className={"flex-auto border-t-2 transition duration-500 ease-in-out " + className}/>
        );
    }
}

export default RegisterLine;
