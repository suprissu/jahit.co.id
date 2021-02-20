import React, { useState, useEffect } from "react";
import { useData } from "../utils/Context";
import ConfirmationDialog from "./ConfirmationDialog";

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
        <ConfirmationDialog
            data={form}
            onClose={onClose}
            method="POST"
            url={path}
        />
    );
};

export default AcceptNegotiationDialog;
