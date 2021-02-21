import React, { useState } from "react";
import {
    Heading,
    Box,
    HStack,
    VStack,
    IconButton,
    Image,
    Popover,
    PopoverTrigger,
    PopoverContent,
    PopoverArrow,
    PopoverCloseButton,
    PopoverHeader,
    PopoverBody,
    Input,
    Text,
    Spinner
} from "@chakra-ui/react";
import CustomTag from "@components/tablist/CustomTag";
import { useData, useProps, useMobile } from "@utils/Context";
import _ from "lodash";
import { ChatIcon, ArrowForwardIcon } from "@chakra-ui/icons";
import axios from "axios";
import { dateFormat } from "../../../utils/helper";

const Message = ({ data }) => {
    const { role, message, created_at } = data;
    const { userRole } = useProps();

    const alignRole = msgRole => {
        if (msgRole === "customer") return "flex-end";
        else return "flex-start";
    };

    const bgRole = msgRole => {
        if (msgRole === "customer") return "red.500";
        else return "white";
    };

    const colorRole = msgRole => {
        if (msgRole === "customer") return "white";
        else return "black";
    };

    return (
        <Box
            maxWidth="80%"
            display="flex"
            flexDirection="column"
            alignSelf={alignRole(role)}
        >
            <VStack
                borderRadius="10px"
                borderWidth="1px"
                alignItems={alignRole(role)}
                padding={3}
                bgColor={bgRole(role)}
                color={colorRole(role)}
            >
                <Text>{message}</Text>
            </VStack>
            <Text size="sm">{created_at}</Text>
        </Box>
    );
};

const Messages = ({ data }) => {
    return (
        <VStack
            height="100%"
            width="100%"
            flexDirection="column-reverse"
            overflowY="auto"
        >
            <VStack width="100%" padding={4}>
                {data[0].admin_chats.map((data, index) => {
                    if (_.isEmpty(data)) return null;
                    else
                        return (
                            <VStack width="100%" key={index}>
                                <Message data={data} />
                            </VStack>
                        );
                })}
            </VStack>
        </VStack>
    );
};

const ChatContainer = () => {
    const { isMobile } = useProps();
    const { adminInbox } = useProps();
    const [message, setMessage] = useState("");
    const [loading, setLoading] = useState(false);

    const messageId = adminInbox ? adminInbox[0].id : -1;

    const sendMessage = () => {
        setLoading(true);
        axios
            .post("/home/inbox/replyAdmin/" + messageId, { message })
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
        <VStack
            width={isMobile ? "100%" : "auto"}
            height="100%"
            flex="1"
            justifyContent="center"
            alignItems="center"
        >
            {adminInbox ? (
                <Messages data={adminInbox} />
            ) : (
                <VStack margin={4}>
                    <Image
                        boxSize="240px"
                        objectFit="contain"
                        borderRadius="5px"
                        src="/img/empty-chat.svg"
                        alt="preview"
                        loading="lazy"
                    />
                    <Heading as="h4" size="md">
                        Mulai transaksi untuk chat.
                    </Heading>
                </VStack>
            )}
            <HStack width="100%">
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
        </VStack>
    );
};

const AdminChat = () => {
    const { isMobile } = useProps();

    if (isMobile === null) return null;

    return (
        <VStack
            width="320px"
            position="fixed"
            zIndex="99"
            bottom="81px"
            right="5vw"
            paddingX="2rem"
            alignItems="flex-end"
        >
            <Popover>
                <PopoverContent margin={4}>
                    <PopoverHeader>Admin Chat</PopoverHeader>
                    <PopoverBody>
                        <ChatContainer />
                    </PopoverBody>
                    <PopoverCloseButton />
                </PopoverContent>
                <PopoverTrigger>
                    <IconButton colorScheme="red" icon={<ChatIcon />} />
                </PopoverTrigger>
            </Popover>
        </VStack>
    );
};

export default AdminChat;
