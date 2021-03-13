import React, { useState, useEffect } from "react";
import TemplateDialog from "@components/dialog/TemplateDialog";
import NormalInput from "@components/NormalInput";

const RejectionDialog = ({ data, onClose, path }) => {
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
        <TemplateDialog
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
            url={path}
        />
    );
};

export default RejectionDialog;
