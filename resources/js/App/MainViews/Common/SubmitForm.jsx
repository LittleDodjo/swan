import React, {Component} from 'react';
import Loading from "./Loading";

class SubmitForm extends Component {

    constructor(props) {
        super(props);


        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(){

    }


    render() {
        return (
            <div className="mb-4 flex mx-auto">
                <button type="button" value={this.props.value} onClick={this.props.action}
                       className="inline-flex rounded-full px-6 py-2 shadow-md transition-colors delay-75 ease-in hover:bg-indigo-500 hover:text-white">
                    {this.props.isLoading ? <Loading/> : ""}
                    <h1 className="my-auto">{this.props.value}</h1>
                </button>
                {this.props.isRemember ?
                <div className="flex items-center mx-10 my-auto">
                    <input id="rememberMe" type="checkbox"
                           className="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"/>
                    <label htmlFor="rememberMe"  className="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Запомнить
                        меня</label>
                </div>: ""}
            </div>
        );
    }
}

export default SubmitForm;
