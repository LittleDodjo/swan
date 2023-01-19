import React from 'react';
import {useParams, useNavigate} from 'react-router-dom';
import CookieProvider from "./Providers/CookieProvider";

const withRouter = WrappedComponent => props => {
    const cookieProvider = new CookieProvider();
    const params = useParams();
    const navigate = useNavigate();
    const roles = JSON.parse(cookieProvider.readSession('roles'));
    const user = JSON.parse(cookieProvider.readSession('user'));

    return (
        <WrappedComponent
            params={params}
            navigate={navigate}
            roles={roles}
            user={user}
            {...props}
        />
    );
};

export default withRouter;
