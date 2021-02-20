import React from "react";
import { Box, VStack, Text, HStack } from "@chakra-ui/react";
import { useData, useProps } from "../../../utils/Context";
import InitiationChat from "./InitiationChat";

const ChatTemplate = ({ data }) => {
    const { selectedData } = useData();
    const { userRole } = useProps();
    const { type } = data;

    if (type === "INISIASI") {
        return (
            <InitiationChat
                data={data}
                rejectPath="/home/inbox/nego/reject"
                acceptPath="/home/inbox/nego/offer"
            />
        );
    } else {
        return (
            <VStack width="60%" borderWidth="1px" padding={3}>
                <Text>
                    Kamu telah mengajukan Proyek{" "}
                    <strong>{selectedData.project.name}</strong>{" "}
                    <Text
                        as="a"
                        href={`/home/project/${selectedData.project_id}`}
                    >
                        #{selectedData.project_id}
                    </Text>{" "}
                    dengan:
                </Text>
                <HStack width="100%" justifyContent="space-between">
                    <Text>Harga</Text>
                    <Text color="gray.400">{selectedData.project.cost}</Text>
                </HStack>
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
            <ChatTemplate data={data} />
        </Box>
    );
};

export default Chat;
