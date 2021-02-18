import React, { useState, createContext, useContext } from "react";
export const DataContext = createContext();
export const PropsContext = createContext();
export const MobileContext = createContext();
import _ from "lodash";

export function useData() {
    return useContext(DataContext);
}

export function useProps() {
    return useContext(PropsContext);
}

export function useMobile() {
    return useContext(MobileContext);
}

const ContextProvider = params => {
    const { children } = params;
    const props = _.pickBy(params, (value, key) => key !== "children");
    const [selectedData, setSelectedData] = useState(null);
    const [isMobile, setIsMobile] = useState(null);

    return (
        <MobileContext.Provider value={{ isMobile, setIsMobile }}>
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
        </MobileContext.Provider>
    );
};

export default ContextProvider;
