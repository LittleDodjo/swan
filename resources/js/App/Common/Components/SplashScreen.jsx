import React, {Component} from 'react';
import Close24 from "../Resources/Close24";

class SplashScreen extends Component {

    constructor(props) {
        super(props);

        this.wrapperRef = React.createRef();
        this.handleClickOutside = this.handleClickOutside.bind(this)
    }


    componentDidMount() {
        this.setState({isOpen: this.props.state});
        document.addEventListener("mousedown", this.handleClickOutside);
    }

    componentWillUnmount() {
        document.removeEventListener("mousedown", this.handleClickOutside);
    }

    handleClickOutside(event) {
        if (this.wrapperRef && !this.wrapperRef.current.contains(event.target)) {
            this.props.action(false);
        }
    }


    render() {
        const hidden = this.props.state ? "" : " hidden";
        return (
            <div className={`splash-screen ${hidden}`}>
                <div className="splash-screen-ref" ref={this.wrapperRef}>
                    <div className="splash-screen-line"></div>
                    <div className="splash-screen-caption">
                        <p className="">{this.props.caption}</p>
                        <Close24 action={this.props.action} class="hover:fill-indigo-500 cursor-pointer mx-4"/>
                    </div>
                        {this.props.children}
                </div>
            </div>
        );
    }
}

export default SplashScreen;
