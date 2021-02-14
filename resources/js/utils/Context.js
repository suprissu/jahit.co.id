import React, { useState, createContext } from "react";
export const Context = createContext();

const ContextProvider = ({ children }) => {
    const [isOpen, setIsOpen] = useState(false);
    const [modalTitle, setModalTitle] = useState("Tambah Proyek");
    const [selectedData, setSelectedData] = useState(null);

    return (
        <Context.Provider
            value={{
                isOpen,
                setIsOpen,
                modalTitle,
                setModalTitle,
                selectedData,
                setSelectedData
            }}
        >
            {children}
        </Context.Provider>
    );
};

export default ContextProvider;
