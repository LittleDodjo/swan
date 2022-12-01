import React, {Component} from 'react';

class MainLogo extends Component {
    render() {
        return (
            <div className="flex w-full flex-col items-center">
                <img
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/Coat_of_arms_of_Chelyabinsk_Oblast.svg/1200px-Coat_of_arms_of_Chelyabinsk_Oblast.svg.png"
                    alt="" className="w-44"/>
                <h1 className="mt-5 mb-4 text-2xl font-light">Министерство социальных отношений Челябинской
                    области</h1>
            </div>
        );
    }
}

export default MainLogo;
