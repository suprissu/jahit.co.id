import React, { useState } from "react";
import {
    Heading,
    HStack,
    VStack,
    Image,
    IconButton,
    Spinner,
    Input
} from "@chakra-ui/react";
import { ArrowForwardIcon } from "@chakra-ui/icons";
import Messages from "@components/admin/Messages";
import { useData } from "@utils/Context";
import axios from "axios";

const InboxContainer = () => {
    const { selectedData } = useData();
    const [message, setMessage] = useState("");
    const [loading, setLoading] = useState(false);

    const sendMessage = () => {
        setLoading(true);
        axios
            .post("/home/inbox/chatAdmin/" + selectedData.id, {
                message
            })
            .then(response => {
                window.location = response.request.responseURL;
            })
            .catch(e => {
                alert("FAILED TO SEND MESSAGE");
                console.log(e);
            })
            .finally(() => {
                setLoading(false);
            });
    };

    return (
        <VStack width="100%" height="100%" flex="1" borderWidth="1px">
            {selectedData && selectedData.admin_chats ? (
                <Messages data={selectedData} />
            ) : (
                <VStack
                    flex="1"
                    margin={4}
                    justifyContent="center"
                    alignItems="center"
                >
                    <Image
                        boxSize="240px"
                        objectFit="contain"
                        borderRadius="5px"
                        src="/img/empty-chat.svg"
                        alt="preview"
                        loading="lazy"
                    />
                    <Heading as="h4" size="md">
                        Mulai chat sekarang.
                    </Heading>
                </VStack>
            )}
            {selectedData && selectedData.id ? (
                <HStack width="100%" p={2}>
                    <Input
                        isRequired={true}
                        placeholder="Masukkan pesan kamu di sini"
                        value={message}
                        onChange={e => setMessage(e.target.value)}
                    />
                    <IconButton
                        disabled={loading || message === ""}
                        onClick={sendMessage}
                        colorScheme="red"
                        icon={loading ? <Spinner /> : <ArrowForwardIcon />}
                    />
                </HStack>
            ) : null}
        </VStack>
    );
};

export default InboxContainer;
