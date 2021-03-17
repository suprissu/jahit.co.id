import React, { useState } from "react";
import { Heading, Box, VStack, Text, HStack } from "@chakra-ui/react";
import { useData, useProps } from "@utils/Context";
import { dateFormat } from "@utils/helper";

const NavigationItem = ({ item }) => {
    const { selectedData, setSelectedData } = useData();

    return item.map((data, index) => (
        <HStack
            width="100%"
            borderWidth="1px"
            borderRadius="10px"
            padding={3}
            key={index}
            bgColor={
                selectedData && selectedData.id === data.id
                    ? "red.100"
                    : "white"
            }
            borderColor={
                selectedData && selectedData.id === data.id
                    ? "red.500"
                    : "gray.200"
            }
            onClick={() => setSelectedData(data)}
            cursor="pointer"
        >
            <VStack width="100%">
                <Text fontSize="xs" alignSelf="flex-start">
                    {dateFormat(
                        data.admin_chats[data.admin_chats.length - 1].created_at
                    )}
                </Text>
                <Box width="100%">
                    <Heading mt="-5px" as="h5" size="sm" alignSelf="flex-start">
                        {data.receiver.name}
                    </Heading>
                    <Text alignSelf="flex-start">
                        {data.admin_chats && data.admin_chats.length > 0
                            ? data.admin_chats[data.admin_chats.length - 1]
                                  .message
                            : null}
                    </Text>
                </Box>
            </VStack>
        </HStack>
    ));
};

const NavigationInbox = () => {
    const { inboxes } = useProps();

    return (
        <VStack height="100%" position="relative">
            <VStack width="100%" overflowY="auto">
                <NavigationItem item={inboxes} />
            </VStack>
        </VStack>
    );
};

export default NavigationInbox;
