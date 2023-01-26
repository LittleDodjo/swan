import React from 'react';
import {useParams, useNavigate} from 'react-router-dom';
import CookieProvider from "./Providers/CookieProvider";

const withRouter = WrappedComponent => props => {
    const params = useParams();
    const navigate = useNavigate();
    const roles = JSON.parse(CookieProvider.readSession('roles'));
    const user = JSON.parse(CookieProvider.readSession('user'));

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
