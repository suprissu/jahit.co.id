import React from "react";
import { Heading, Box, VStack, Text } from "@chakra-ui/react";
import { useData, useProps } from "../../../utils/Context";
import { dateFormat } from "../../../utils/helper";

const NavigationInbox = () => {
    const { selectedData, setSelectedData } = useData();
    const { inboxes } = useProps();

    return (
        <VStack height="100%" padding={3} borderWidth="1px">
            {inboxes.map((data, index) => (
                <VStack
                    width="100%"
                    borderWidth="1px"
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
                    <Text fontSize="xs" alignSelf="flex-end">
                        {dateFormat(
                            data.chats[data.chats.length - 1].created_at
                        )}
                    </Text>
                    <Box width="100%">
                        <Heading
                            mt="-5px"
                            as="h5"
                            size="sm"
                            alignSelf="flex-start"
                        >
                            {data.partner.company_name}
                        </Heading>
                        <Text alignSelf="flex-start">{data.project.name}</Text>
                    </Box>
                </VStack>
            ))}
        </VStack>
    );
};

export default NavigationInbox;
