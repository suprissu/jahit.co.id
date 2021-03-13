import React, { useState, useEffect } from "react";
import TemplateDialog from "@components/dialog/TemplateDialog";

const AcceptNegotiationDialog = ({ data, selectedData, onClose, path }) => {
    const [form, setForm] = useState(null);

    useEffect(() => {
        setForm({
            chatID: data.id,
            inboxID: selectedData.id,
            negotiationID: data.negotiation.id
        });
    }, []);

    return (
        <TemplateDialog
            data={form}
            onClose={onClose}
            method="POST"
            url={path}
        />
    );
};

export default AcceptNegotiationDialog;
