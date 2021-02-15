import React, { useState, createContext, useContext } from "react";
export const DataContext = createContext();
export const PropsContext = createContext();
import _ from "lodash";

export function useData() {
    return useContext(DataContext);
}

export function useProps() {
    return useContext(PropsContext);
}

const ContextProvider = params => {
    const { children } = params;
    const props = _.pickBy(params, (value, key) => key !== "children");
    const [selectedData, setSelectedData] = useState(null);

    return (
        <PropsContext.Provider value={{ ...props }}>
            <DataContext.Provider
                value={{
                    selectedData,
                    setSelectedData
                }}
            >
                {children}
            </DataContext.Provider>
        </PropsContext.Provider>
    );
};

export default ContextProvider;
