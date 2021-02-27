import React, { useState, createContext, useContext } from "react";
export const DataContext = createContext();
export const PropsContext = createContext();
export const MobileContext = createContext();

export function useData() {
    return useContext(DataContext);
}

export function useProps() {
    return useContext(PropsContext);
}

export function useMobile() {
    return useContext(MobileContext);
}

function pickBy(object, predicate = v => v) {
    return Object.assign(
        ...Object.entries(object)
            .filter(data => predicate(data))
            .map(([key, val]) => ({ [key]: val }))
    );
}

const ContextProvider = params => {
    const { children } = params;
    const props = pickBy(params, ([key, _]) => key !== "children");
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
