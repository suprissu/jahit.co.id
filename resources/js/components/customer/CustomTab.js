import React from "react";
import {
    Box,
    Heading,
    HStack,
    VStack,
    Divider,
    Image,
    Text,
    Button,
    useDisclosure
} from "@chakra-ui/react";
import CustomTag from "../CustomTag";
import { currencyFormat, dateFormat } from "../../utils/helper";
import { useData } from "../../utils/Context";
import CustomAlert from "../CustomAlert";
import ProjectDetail from "../ProjectDetail";

const CustomTab = function CustomTab({ data }) {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const { selectedData, setSelectedData } = useData();
    return (
        <Box padding={5} marginY={2} shadow="md" borderWidth="1px">
            <CustomAlert
                content={<ProjectDetail data={selectedData} editable={true} />}
                isOpen={isOpen}
                onClose={onClose}
            />
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
            <HStack justifyContent="space-between">
                <HStack>
                    {data.images && data.images.length !== 0 ? (
                        <Image
                            boxSize="54px"
                            objectFit="cover"
                            borderRadius="5px"
                            src={data.images[0].path}
                            fallbackSrc="https://via.placeholder.com/54"
                            alt="preview"
                        />
                    ) : null}
                    <Box alignItems="start">
                        <Heading fontSize="md">{data.name}</Heading>
                        <Text fontSize="sm">{data.count} buah</Text>
                    </Box>
                </HStack>
                {!data.cost ? (
                    <Button
                        size="sm"
                        onClick={() => {
                            setSelectedData(data);
                            onOpen();
                        }}
                    >
                        Detail
                    </Button>
                ) : null}
            </HStack>
            <HStack mt={2} justifyContent="space-between">
                {data.cost ? (
                    <>
                        <Box alignItems="start">
                            <Text fontSize="sm">Total harga: </Text>
                            <Text color="orange" fontSize="sm">
                                {currencyFormat(data.cost ?? 0)}
                            </Text>
                        </Box>
                        <Button
                            size="sm"
                            onClick={() => {
                                setSelectedData(data);
                                onOpen();
                            }}
                        >
                            Detail
                        </Button>
                    </>
                ) : null}
            </HStack>
        </Box>
    );
};

export default CustomTab;
