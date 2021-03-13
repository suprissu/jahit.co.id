import React from "react";
import {
    Box,
    Heading,
    HStack,
    VStack,
    Divider,
    Text,
    UnorderedList,
    ListItem,
    ListIcon,
    Badge,
    useDisclosure
} from "@chakra-ui/react";
import { dateFormat } from "@utils/helper";
import { useProps } from "@utils/Context";

const MaterialItem = ({ data }) => {
    const { materials } = useProps();

    const material = materials.find(({ id }) => id === data.material_id);

    return (
        <ListItem>
            <Box display="flex" alignItems="center">
                <Badge>{data.status}</Badge>
                {material.name === "Lainnya" ? (
                    <Text ml={2} fontSize="sm">
                        {data.quantity} {data.additional_info}
                    </Text>
                ) : (
                    <Text ml={2} fontSize="sm">
                        {data.quantity} {material.metric} {material.name}
                    </Text>
                )}
            </Box>
            <Text color="gray.500" fontSize="sm">
                {data.note}
            </Text>
        </ListItem>
    );
};

const TransactionTab = function TransactionTab({ data }) {
    return (
        <Box padding={5} marginY={2} shadow="md" borderWidth="1px">
            <HStack justifyContent="space-between">
                <Box display="flex" flexDir="column" alignItems="start">
                    <Text fontWeight="bold" fontSize="xs">
                        {data.type}
                    </Text>
                    <Text size="sm" fontSize="xs">
                        {dateFormat(data.created_at)}
                    </Text>
                </Box>
            </HStack>
            <Divider my={2} />
            <Heading fontSize="md">{data.name}</Heading>
            <HStack mt={2} justifyContent="space-between">
                <Box alignItems="start">
                    <Text fontSize="sm" fontWeight="bold">
                        Bahan:
                    </Text>
                    <UnorderedList>
                        {data.material_requests.map((data, index) => (
                            <MaterialItem data={data} key={index} />
                        ))}
                    </UnorderedList>
                </Box>
            </HStack>
        </Box>
    );
};

export default TransactionTab;
