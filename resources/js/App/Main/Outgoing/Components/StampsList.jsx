import React, {Component} from 'react';
import toast from "react-hot-toast";

class StampsList extends Component {

    constructor(props) {
        super(props);
        this.state = {
            stamps: [],
        };


    }

    render() {
        let recomended = "";
        if (this.props.recomended) recomended = 'border-green-500';
        return (
            <>
                {this.props.recomended ?
                    <div className="flex pb-2 mb-2">
                        <p className="text-lg text-green-600">
                            Система рекомендует вам использовать эти марки, если вы не согласны, можете поменять
                            выбор.
                        </p>
                    </div> : ""
                }
                <div className={"p-4 rounded-lg border bg-gray-100 flex flex-wrap select-none " + recomended}>
                    {this.props.stamps.map((value, key) => (
                        <div className="m-4 border rounded-xl shadow-md border-indigo-500 cursor-pointer flex"
                             key={key}>
                            <p className="font-light p-2 my-auto">Марка {value.value} руб. </p>
                            <p className="font-bold p-2 my-auto">{value.count} шт.</p>
                            <div className="flex ml-4 rounded-r-xl rounded-l-xl bg-gray-200">
                                <p className=" p-4 hover:bg-slate-300 hover:fill-indigo-500 text-xl"
                                   onClick={(e) => {
                                       const stampsCount = this.props.stamps.filter(stamp => stamp.id === value.id)[0].count;
                                       const stampsMax = this.props.stamps.filter(stamp => stamp.id === value.id)[0].max;
                                       if (stampsCount + 1 > stampsMax) {
                                           toast.error("Больше нет марок наа баллансе!");
                                           return;
                                       }
                                       this.props.stamps.filter(stamp => stamp.id === value.id)[0].count++;
                                   }}>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z"/>
                                        <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"/>
                                    </svg>
                                </p>
                                <p className="p-4 hover:bg-slate-300 hover:fill-indigo-500 text-xl"
                                   onClick={(e) => {
                                       const stampsCount = this.props.stamps.filter(stamp => stamp.id === value.id)[0].count;
                                       if (stampsCount - 1 < 1) {
                                           const stamps = this.props.stamps;
                                           this.props.action(stamps.filter(stamp => stamp.id !== value.id));
                                       } else {
                                           this.props.stamps.filter(stamp => stamp.id === value.id)[0].count--;
                                       }
                                   }}>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z"/>
                                        <path d="M5 11h14v2H5z"/>
                                    </svg>
                                </p>
                                <p className="rounded-r-xl p-4 hover:bg-slate-300 hover:fill-red-500"
                                   onClick={() => {
                                       const stamps = this.props.stamps;
                                       this.props.action(stamps.filter(stamp => stamp.id !== value.id));
                                   }}>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z"/>
                                        <path
                                            d="M20 7v14a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7H2V5h20v2h-2zM6 7v13h12V7H6zm1-5h10v2H7V2zm4 8h2v7h-2v-7z"/>
                                    </svg>
                                </p>
                            </div>
                        </div>
                    ))}
                </div>
            </>
        );
    }
}

export default StampsList;
