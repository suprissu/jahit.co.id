import React from "react";
import axios from "axios";
import { VStack, Text, HStack, Button } from "@chakra-ui/react";

const ConfirmationDialog = ({ onClose, url, method, data, content }) => {
    const sendCommand = () => {
        axios({
            method,
            url,
            data
        })
            .then(response => {
                window.location = response.request.responseURL;
            })
            .catch(e => {
                console.log(e);
            });
    };

    return (
        <VStack alignItems="flex-start">
            {content ?? <Text>Apakah kamu yakin dengan hal ini ?</Text>}
            <HStack alignSelf="flex-end">
                <Button onClick={onClose}>Batal</Button>
                <Button colorScheme="teal" onClick={sendCommand}>
                    Yakin
                </Button>
            </HStack>
        </VStack>
    );
};

export default ConfirmationDialog;
