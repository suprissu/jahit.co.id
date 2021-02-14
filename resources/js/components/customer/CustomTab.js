import React from "react";
import {
    Box,
    Heading,
    HStack,
    VStack,
    Divider,
    Image,
    Text,
    Button
} from "@chakra-ui/react";
import CustomTag from "./CustomTag";
import { currencyFormat, dateFormat } from "../../utils/helper";

const CustomTab = function CustomTab({ data }) {
    return (
        <Box p={5} shadow="md" borderWidth="1px">
            <HStack justifyContent="space-between">
                <VStack alignItems="start">
                    <Text size="sm" fontSize="xs">
                        {dateFormat(data.created_at)}
                    </Text>
                </VStack>
                <VStack>
                    <CustomTag data={data} />
                </VStack>
            </HStack>
            <Divider my={2} />
            <HStack>
                {data.images ? (
                    <Image
                        boxSize="54px"
                        objectFit="cover"
                        borderRadius="5px"
                        src={data.images[1].path}
                        alt="preview"
                    />
                ) : null}
                <Box alignItems="start">
                    <Heading fontSize="md">{data.name}</Heading>
                    <Text fontSize="sm">{data.count} buah</Text>
                </Box>
            </HStack>
            <HStack mt={2} justifyContent="space-between">
                <Box alignItems="start">
                    <Text fontSize="sm">Total harga: </Text>
                    <Text color="orange" fontSize="sm">
                        {currencyFormat(data.cost ?? 0)}
                    </Text>
                </Box>
                <Button size="sm">Detail</Button>
            </HStack>
        </Box>
    );
};

export default CustomTab;
