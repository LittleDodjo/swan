import React, {Component} from 'react';

class MarksStatistic extends Component {
    render() {
        return (
            <div className="mx-10 flex flex-col rounded-xl border bg-white shadow-lg">
                <h1 className="p-4 text-xl font-light">Статистика на сегодня</h1>
                <div>
                    <div className="shadow-lg rounded-lg overflow-hidden">
                        <div className="py-3 px-5 bg-gray-50">Line chart</div>
                        <canvas className="p-10" id="chartLine"></canvas>
                    </div>
                </div>
            </div>
        );
    }
}

export default MarksStatistic;
