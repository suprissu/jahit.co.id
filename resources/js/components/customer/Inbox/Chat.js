import React from "react";
import { Box, VStack, Text } from "@chakra-ui/react";
import { useData, useProps } from "../../../utils/Context";
import ConfirmationChat from "./ConfirmationChat";

const ChatTemplate = ({ msg }) => {
    const { selectedData } = useData();
    console.log(msg);
    const { type } = msg;

    if (type === "INISIASI") {
        return (
            <ConfirmationChat
                id={selectedData.project.id}
                title={selectedData.project.name}
                content=""
                rejectPath="/home/inbox/nego/reject"
                acceptPath=""
            />
        );
    } else {
        return (
            <VStack borderWidth="1px" padding={3}>
                <Text>Kamu telah mengajukan {selectedData.project.name}</Text>
            </VStack>
        );
    }
};

const Chat = ({ data }) => {
    const { role } = data;
    const { userRole } = useProps();

    const alignRole = msgRole => {
        if (msgRole === "ADMIN") return "center";
        else if (msgRole === userRole) return "flex-end";
        else return "flex-start";
    };

    const bgColorRole = msgRole => {
        if (msgRole === "ADMIN") return "gray.200";
        else if (msgRole === userRole) return "red.500";
        else return "white";
    };

    const colorRole = msgRole => {
        if (msgRole === userRole) return "white";
        else return "black";
    };

    return (
        <Box alignSelf={alignRole(role)}>
            <ChatTemplate msg={data} />
        </Box>
    );
};

export default Chat;
