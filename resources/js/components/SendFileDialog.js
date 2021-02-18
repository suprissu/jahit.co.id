import React, { useState } from "react";
import axios from "axios";
import Dropzone from "./Dropzone";
import { VStack, HStack, Button } from "@chakra-ui/react";

const SendFileDialog = ({ onClose, path }) => {
    const [file, setFile] = useState([]);

    const sendCommand = () => {
        const formData = new FormData();
        file.forEach(data => {
            formData.append("shipment_receipt_path", data);
        });
        axios
            .post(path, formData)
            .then(response => {
                window.location = response.request.responseURL;
            })
            .catch(e => {
                console.log(e);
            });
    };

    return (
        <VStack alignItems="flex-start">
            <Dropzone
                title="Upload Bukti Resi"
                name="shipment_receipt_path"
                value={file}
                setValue={setFile}
            />
            <HStack alignSelf="flex-end">
                <Button onClick={onClose}>Batal</Button>
                <Button colorScheme="teal" onClick={sendCommand}>
                    Yakin
                </Button>
            </HStack>
        </VStack>
    );
};

export default SendFileDialog;
