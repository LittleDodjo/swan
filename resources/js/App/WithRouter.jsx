import React from 'react';
import { useParams } from 'react-router-dom';

const WithRouter = WrappedComponent => props => {
    const params = useParams();

    const exit = () => {
        console.log("exit");
    };

    return (
        <WrappedComponent
            {...props}
            params={params}
            action={exit}
        />
    );
};

export default WithRouter;
