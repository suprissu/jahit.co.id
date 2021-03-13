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
    Badge,
    useDisclosure
} from "@chakra-ui/react";
import CustomTag from "@components/tablist/CustomTag";
import { currencyFormat, dateFormat } from "@utils/helper";
import { useData, usePanelType } from "@utils/Context";
import UserDetail from "@components/admin/UserDetail";
import AlertDialog from "@components/dialog/AlertDialog";

const UserTab = ({ data }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const { selectedType } = usePanelType();
    const { selectedData, setSelectedData } = useData();

    return (
        <Box padding={5} marginY={2} shadow="md" borderWidth="1px">
            <AlertDialog
                content={<UserDetail data={selectedData} />}
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
                    {data.user && (
                        <Badge
                            colorScheme={data.user.is_active ? "teal" : "gray"}
                        >
                            {data.user.is_active ? "Aktif" : "Belum Aktif"}
                        </Badge>
                    )}
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
                        <Heading fontSize="md">{data.user.name}</Heading>
                        <Text color="gray.400" fontSize="sm">
                            {data.phone_number}
                        </Text>
                        <Text color="gray.400" fontSize="sm">
                            {data.user.email}
                        </Text>
                    </Box>
                </HStack>
                <Button
                    size="sm"
                    onClick={() => {
                        setSelectedData(data);
                        onOpen();
                    }}
                >
                    Detail
                </Button>
            </HStack>
        </Box>
    );
};

export default UserTab;
