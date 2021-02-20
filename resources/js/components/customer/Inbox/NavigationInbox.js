import React, { useEffect, useState } from "react";
import { Heading, Box, VStack, Text, HStack, Avatar } from "@chakra-ui/react";
import { useData, useProps } from "../../../utils/Context";
import { dateFormat } from "../../../utils/helper";
import InitiationChat from "../../InitiateNegotiationChat";

const NavigationInbox = () => {
    const { selectedData, setSelectedData } = useData();
    const { inboxes } = useProps();
    const [offers, setOffers] = useState([]);
    const [running, setRunning] = useState([]);

    useEffect(() => {
        const off = inboxes.filter(data => data.chats.length === 1);
        const run = inboxes.filter(data => data.chats.length > 1);
        setOffers(off);
        setRunning(run);
    }, []);

    return (
        <VStack>
            <Box
                display="flex"
                alignItems="flex-start"
                justifyContent="flex-start"
                height="220px"
                width="100%"
                overflowX="auto"
            >
                {offers.map((data, index) => (
                    <InitiationChat
                        key={index}
                        data={data.chats[0]}
                        selectedData={data}
                    />
                ))}
            </Box>
            <VStack width="100%" overflowY="auto">
                {running.map((data, index) => (
                    <HStack
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
                        <Avatar
                            name={data.project.name}
                            src={
                                data && data.project.images.length !== 0
                                    ? data.project.images[0].path
                                    : ""
                            }
                        />
                        <VStack width="100%">
                            <Text fontSize="xs" alignSelf="flex-start">
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
                                <Text alignSelf="flex-start">
                                    {data.project.name}
                                </Text>
                            </Box>
                        </VStack>
                    </HStack>
                ))}
            </VStack>
        </VStack>
    );
};

export default NavigationInbox;
