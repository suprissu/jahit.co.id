import React from "react";
import { Heading, Box, VStack } from "@chakra-ui/react";
import { useData, useMobile } from "../../../utils/Context";
import CustomTag from "../../CustomTag";
import Message from "./Message";

const Messages = () => {
    const { selectedData } = useData();
    const { isMobile } = useMobile();

    return (
        <>
            <Box
                padding={4}
                display="flex"
                flexDirection={isMobile ? "column" : "row"}
                width="100%"
                borderBottomWidth="1px"
                justifyContent="space-between"
                alignItems={isMobile ? "flex-start" : "center"}
            >
                <Heading my="5px" as="h5" size="sm" alignSelf="flex-start">
                    {selectedData.partner.company_name}
                </Heading>
                <CustomTag data={selectedData.project} />
            </Box>
            <VStack
                height="100%"
                width="100%"
                flexDirection="column-reverse"
                overflowY="auto"
            >
                <VStack width="100%" padding={4}>
                    {selectedData.chats.map((data, index) => (
                        <VStack width="100%" key={index}>
                            <Message data={data} />
                        </VStack>
                    ))}
                </VStack>
            </VStack>
        </>
    );
};

export default Messages;
