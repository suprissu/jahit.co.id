import React, { useState, useEffect, createContext, useContext } from "react";
export const DataContext = createContext();
export const PropsContext = createContext();
export const MobileContext = createContext();
export const PanelTypeContext = createContext();

export function useData() {
    return useContext(DataContext);
}

export function useProps() {
    return useContext(PropsContext);
}

export function useMobile() {
    return useContext(MobileContext);
}

export function usePanelType() {
    return useContext(PanelTypeContext);
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
    const [selectedType, setSelectedType] = useState(null);
    const [isMobile, setIsMobile] = useState(null);

    useEffect(() => {
        if (window.innerWidth < 767) {
            setIsMobile(true);
        } else {
            setIsMobile(false);
        }
        window.addEventListener("resize", e => {
            if (e.target.innerWidth < 767) {
                setIsMobile(true);
            } else {
                setIsMobile(false);
            }
        });
    }, []);

    if (isMobile === null) return null;

    return (
        <MobileContext.Provider value={{ isMobile, setIsMobile }}>
            <PropsContext.Provider value={{ ...props }}>
                <PanelTypeContext.Provider
                    value={{
                        selectedType,
                        setSelectedType
                    }}
                >
                    <DataContext.Provider
                        value={{
                            selectedData,
                            setSelectedData
                        }}
                    >
                        {children}
                    </DataContext.Provider>
                </PanelTypeContext.Provider>
            </PropsContext.Provider>
        </MobileContext.Provider>
    );
};

export default ContextProvider;
