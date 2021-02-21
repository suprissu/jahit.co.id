import React from "react";
import axios from "axios";
import { VStack, Text, HStack, Button } from "@chakra-ui/react";
import _ from "lodash";

const TemplateDialog = ({ onClose, url, method, data, content }) => {
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

    console.log(data);

    return (
        <VStack alignItems="flex-start">
            {content ?? <Text>Apakah kamu yakin dengan hal ini ?</Text>}
            <HStack alignSelf="flex-end">
                <Button onClick={onClose}>Batal</Button>
                <Button
                    disabled={data && _.values(data).includes("")}
                    colorScheme="teal"
                    onClick={sendCommand}
                >
                    Yakin
                </Button>
            </HStack>
        </VStack>
    );
};

export default TemplateDialog;
