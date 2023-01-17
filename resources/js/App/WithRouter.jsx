import React from 'react';
import { useParams, useNavigate } from 'react-router-dom';

const WithRouter = WrappedComponent => props => {
    const params = useParams();
    const navigate = useNavigate();

    return (
        <WrappedComponent
            params={params}
            navigate={navigate}
            {...props}
        />
    );
};

export default WithRouter;
