import React, { useState, createContext } from "react";
export const Context = createContext();

const ContextProvider = ({ children }) => {
    const [isOpen, setIsOpen] = useState(false);
    const [selectedData, setSelectedData] = useState(null);

    return (
        <Context.Provider
            value={{
                isOpen,
                setIsOpen,
                selectedData,
                setSelectedData
            }}
        >
            {children}
        </Context.Provider>
    );
};

export default ContextProvider;
