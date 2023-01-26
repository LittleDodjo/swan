import React, {Component} from 'react';
import Loading24 from "../../Common/Resources/Loading24";

class SplashLoader extends Component {
    render() {
        return (
            <div className="h-screen w-screen flex justify-center">
                <div className="my-auto ">
                    <div className="justify-center flex my-4">
                        <Loading24 class="mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"/>
                    </div>
                    <div className="mx-auto my-4">
                        <h1 className="text-center font-light">Подождите, идет загрузка</h1>
                    </div>
                </div>
            </div>
        );
    }
}

export default SplashLoader;
