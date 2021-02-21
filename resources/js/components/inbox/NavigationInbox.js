import React, { useEffect, useState } from "react";
import { Heading, Box, VStack, Text, HStack, Avatar } from "@chakra-ui/react";
import { Card, Placeholder } from "semantic-ui-react";
import { useData, useProps } from "@utils/Context";
import { dateFormat } from "@utils/helper";
import InitiationChat from "@components/inbox/chat/InitiateNegotiationChat";

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
                    {dateFormat(data.chats[data.chats.length - 1].created_at)}
                </Text>
                <Box width="100%">
                    <Heading mt="-5px" as="h5" size="sm" alignSelf="flex-start">
                        {data.partner.company_name}
                    </Heading>
                    <Text alignSelf="flex-start">{data.project.name}</Text>
                </Box>
            </VStack>
        </HStack>
    ));
};

const ProjectOffers = ({ offers }) =>
    offers.map((data, index) => (
        <Box minWidth="240px" margin={2} key={index}>
            <InitiationChat
                key={index}
                data={data.chats[0]}
                selectedData={data}
            />
        </Box>
    ));

const Skeleton = () => (
    <Box width="100%" height="80%" margin={2}>
        <Card style={{ width: "100%", height: "100%" }}>
            <Card.Content>
                <Placeholder fluid>
                    <Placeholder.Paragraph>
                        <Placeholder.Line length="short" />
                        <Placeholder.Line length="very short" />
                        <Placeholder.Line length="medium" />
                        <Placeholder.Line length="medium" />
                    </Placeholder.Paragraph>
                </Placeholder>
            </Card.Content>
        </Card>
    </Box>
);

const SkeletonNav = () => (
    <Box width="100%" margin={2} padding={2}>
        <Card style={{ height: "100%", width: "100%" }}>
            <Card.Content>
                <Placeholder fluid>
                    <Placeholder.Paragraph>
                        <Placeholder.Line length="short" />
                        <Placeholder.Line length="medium" />
                        <Placeholder.Line length="medium" />
                    </Placeholder.Paragraph>
                </Placeholder>
            </Card.Content>
        </Card>
    </Box>
);

const NavigationInbox = () => {
    const { inboxes, userRole } = useProps();
    const [offers, setOffers] = useState([]);
    const [running, setRunning] = useState([]);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        const off = inboxes.filter(data => data.chats.length === 1);
        const run = inboxes.filter(data => data.chats.length > 1);
        setOffers(off);
        setRunning(run);
        setIsLoading(false);
    }, []);

    return (
        <VStack>
            {userRole === "VENDOR" ? (
                <Box
                    display="flex"
                    alignItems="flex-start"
                    justifyContent="flex-start"
                    height="220px"
                    width="100%"
                    overflowX="auto"
                >
                    {isLoading ? (
                        <Skeleton />
                    ) : (
                        <ProjectOffers offers={offers} />
                    )}
                </Box>
            ) : null}
            <VStack width="100%" overflowY="auto">
                {isLoading ? (
                    <SkeletonNav />
                ) : (
                    <NavigationItem item={running} />
                )}
            </VStack>
        </VStack>
    );
};

export default NavigationInbox;
