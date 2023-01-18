import React, {Component} from 'react';

class OutgoingView extends Component {
    render() {
        return (
            <div className="flex flex-col">
                <div className="flex flex-col">
                    <div className="m-4 flex justify-between">
                        <p className="mx-4 basis-1/4 text-3xl font-light">Исходящая документация</p>
                        <div className="flex basis-4/5 my-auto">
                            <svg className="my-auto mx-2 rounded-full hover:bg-indigo-500 hover:fill-white"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"/>
                                <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"/>
                            </svg>
                            <input className="my-auto h-7 w-full rounded-full text-sm" type="email" name="text"
                                   placeholder="search" id=""/>
                        </div>
                    </div>
                    table
                </div>
            </div>
        );
    }
}

export default OutgoingView;
