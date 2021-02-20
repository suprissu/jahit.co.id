import React, { useState, useEffect } from "react";
import ConfirmationDialog from "./ConfirmationDialog";
import NormalInput from "./NormalInput";

const RejectionDialog = ({ data, onClose, rejectPath }) => {
    const [chatID, setChatID] = useState(null);
    const [excuse, setExcuse] = useState("");
    const [form, setForm] = useState(null);

    useEffect(() => {
        setChatID(data.id);
    }, []);

    useEffect(() => {
        setForm({ chatID, excuse });
    }, [excuse]);

    return (
        <ConfirmationDialog
            content={
                <NormalInput
                    isRequired={true}
                    title="Alasan Menolak Proyek"
                    name="excuse"
                    type="textarea"
                    value={excuse}
                    setValue={setExcuse}
                />
            }
            data={form}
            onClose={onClose}
            method="POST"
            url={rejectPath}
        />
    );
};

export default RejectionDialog;
