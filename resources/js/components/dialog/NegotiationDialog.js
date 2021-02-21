import React, { useState, useEffect } from "react";
import TemplateDialog from "@components/dialog/TemplateDialog";
import NormalInput from "@components/NormalInput";

const NegotiationDialog = ({ data, selectedData, onClose, path }) => {
    const [projectID, setProjectID] = useState(null);
    const [customerID, setCustomerID] = useState(null);
    const [partnerID, setPartnerID] = useState(null);
    const [inboxID, setInboxID] = useState(null);
    const [chatID, setChatID] = useState(null);
    const [cost, setCost] = useState("");
    const [startDate, setStartDate] = useState("");
    const [deadline, setDeadline] = useState("");
    const [form, setForm] = useState(null);

    useEffect(() => {
        setChatID(data.id);
        setInboxID(selectedData.id);
        setProjectID(selectedData.project_id);
        setCustomerID(selectedData.customer_id);
        setPartnerID(selectedData.partner_id);
    }, []);

    useEffect(() => {
        setForm({
            projectID,
            customerID,
            partnerID,
            inboxID,
            chatID,
            cost,
            startDate,
            deadline
        });
    }, [cost, startDate, deadline]);

    return (
        <TemplateDialog
            content={
                <>
                    <NormalInput
                        isRequired={true}
                        title="Harga"
                        name="cost"
                        type="number"
                        value={cost}
                        setValue={setCost}
                    />
                    <NormalInput
                        isRequired={true}
                        title="Mulai Pengerjaan"
                        name="startDate"
                        type="date"
                        min={new Date().toISOString().split("T")[0]}
                        value={startDate}
                        setValue={setStartDate}
                    />
                    <NormalInput
                        isRequired={true}
                        title="Selesai Pengerjaan"
                        name="deadline"
                        type="date"
                        min={
                            startDate !== ""
                                ? startDate
                                : new Date().toISOString().split("T")[0]
                        }
                        value={deadline}
                        setValue={setDeadline}
                    />
                </>
            }
            data={form}
            method="POST"
            onClose={onClose}
            url={path}
        />
    );
};

export default NegotiationDialog;
