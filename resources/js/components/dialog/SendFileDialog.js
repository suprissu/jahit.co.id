import React, { useState } from "react";
import axios from "axios";
import Dropzone from "@components/Dropzone";
import { VStack, HStack, Button, Text } from "@chakra-ui/react";

const SendFileDialog = ({ onClose, path, name, data, content }) => {
    const [file, setFile] = useState([]);

    const sendCommand = () => {
        const formData = new FormData();
        if (data)
            Object.keys(data).forEach(key => {
                formData.append(key, data[key]);
            });
        file.forEach(buffer => {
            formData.append(name, buffer);
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
            {content}
            <Dropzone
                title="Upload Bukti Resi"
                name={name}
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
