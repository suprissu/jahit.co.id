import React from "react";
import { Box, VStack, Text } from "@chakra-ui/react";

const Message = ({ data }) => {
    const { role, message, created_at } = data;

    const alignRole = msgRole => {
        if (msgRole === "administrator") return "flex-end";
        else return "flex-start";
    };

    const bgRole = msgRole => {
        if (msgRole === "administrator") return "red.500";
        else return "white";
    };

    const colorRole = msgRole => {
        if (msgRole === "administrator") return "white";
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

export default Message;
