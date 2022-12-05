import React, {Component} from 'react';
import RegisterLine from "./RegisterLine";

class Step extends Component {

    constructor(props) {
        super(props);

    }


    render() {
        if (this.props.step > this.props.id) { //уже прошли
            var className = "border-indigo-600";
        } else if (this.props.step === this.props.id) { //еще не дошли
            var className = "bg-indigo-600 border-indigo-600";
        } else { // Уже прошли
            var className = "border-white";

        }
        return (
            <>
                <div className="relative flex items-center text-white">
                    <div
                        className={"h-12 w-12 rounded-full border-2 py-3 " + className}>
                        {this.props.svg}
                    </div>
                    <div
                        className="absolute top-0 -ml-10 mt-16 w-32 text-center text-xs font-medium uppercase">
                        {this.props.caption}
                    </div>
                </div>
                {this.props.end ? "" : <RegisterLine active={this.props.active}/>}
            </>
        );
    }
}

export default Step;
