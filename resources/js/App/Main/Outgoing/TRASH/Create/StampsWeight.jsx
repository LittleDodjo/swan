import React, {Component} from 'react';

class StampsWeight extends Component {

    constructor(props) {
        super(props);
        this.state = {
            weight: 10,
        };

        this.prepareStamps = this.prepareStamps.bind(this);
        this.handleChange = this.handleChange.bind(this);
    }

//     [
//         10, 20, 40, 60, 80, 100, 'more'
// ],

    handleChange(e) {
        this.setState({[e.target.name]: e.target.value});
    }

    prepareStamps() {
        const w = this.state.weight;
    }

    render() {
        return (
            <div className="flex">
                <p className="basis-2/6 my-auto text-lg font-light p-4 border-r w-full">Укажите вес конверта (грамм)</p>
                <div className="flex basis-4/6">
                    <input placeholder="Введите вес здесь" type="number" onChange={this.handleChange} name="weight"
                           className="basis-4/6  my-auto h-full border-none focus:ring-0 uppercase"
                           value={this.state.weight}/>
                    <input type="button" value="Подтвердить" onClick={this.prepareStamps}
                           className="basis-4/6 hover:text-indigo-500 hover:bg-slate-100 border-l"/>
                </div>
            </div>
        );
    }
}

export default StampsWeight;
