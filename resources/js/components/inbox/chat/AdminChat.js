import React, { useState } from "react";
import {
    Heading,
    Box,
    HStack,
    VStack,
    IconButton,
    Image,
    Input,
    Text,
    Spinner,
    useDisclosure
} from "@chakra-ui/react";
import { useProps, useMobile } from "@utils/Context";
import _ from "lodash";
import { ChatIcon, ArrowForwardIcon, ArrowBackIcon } from "@chakra-ui/icons";
import axios from "axios";

const Message = ({ data }) => {
    const { role, message, created_at } = data;

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
            flex="1"
            height="240px"
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
    const { isMobile } = useMobile();
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
                <VStack flex="1" margin={4}>
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
    const { isOpen, onToggle } = useDisclosure();
    const { isMobile } = useMobile();

    if (isMobile === null) return null;

    console.log(isMobile);

    return (
        <VStack
            position="fixed"
            zIndex="999"
            bottom="81px"
            right={isMobile ? "0" : "5vw"}
            paddingX={isMobile ? "0" : "2rem"}
            alignItems="flex-end"
        >
            {isOpen ? (
                <VStack
                    marginBottom={isMobile ? "-130px" : "0"}
                    height={isMobile ? "100vh" : "auto"}
                    width={isMobile ? "100vw" : "320px"}
                    borderRadius="10px"
                    bgColor="white"
                    borderWidth="1px"
                    zIndex="1"
                    p={4}
                >
                    <HStack width="100%" p={2} borderBottomWidth="1px">
                        {isMobile ? (
                            <IconButton
                                onClick={onToggle}
                                variant="ghost"
                                icon={<ArrowBackIcon />}
                            />
                        ) : null}
                        <Text>Admin Chat</Text>
                    </HStack>
                    <ChatContainer />
                </VStack>
            ) : null}
            <IconButton
                marginRight="1rem"
                onClick={onToggle}
                size="lg"
                colorScheme="red"
                icon={<ChatIcon />}
            />
        </VStack>
    );
};

export default AdminChat;
