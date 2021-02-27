import React, { useState } from "react";
import {
    Heading,
    Box,
    VStack,
    Text,
    HStack,
    Button,
    IconButton,
    useDisclosure
} from "@chakra-ui/react";
import { AddIcon } from "@chakra-ui/icons";
import SelectInput from "@components/SelectInput";
import AlertDialog from "@components/dialog/AlertDialog";
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

const user = [{ id: 99, name: "jojo" }];

const AddInbox = () => {
    const { setSelectedData } = useData();
    const { isOpen, onOpen, onClose } = useDisclosure();
    const [id, setId] = useState(null);

    const userOptions = user.map(data => {
        return {
            key: data.id,
            value: data.id,
            text: data.name
        };
    });

    return (
        <>
            <AlertDialog
                title="Tambah Pesan"
                content={
                    <VStack>
                        <SelectInput
                            name="userID"
                            title="Nama Pengguna"
                            placeholder="Pilih nama pengguna"
                            value={id}
                            setValue={setId}
                            options={userOptions}
                        />
                        <Button
                            mt={4}
                            alignSelf="flex-end"
                            colorScheme="teal"
                            onClick={() => {
                                setSelectedData({ id });
                                onClose();
                            }}
                        >
                            Tambah
                        </Button>
                    </VStack>
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <IconButton
                onClick={onOpen}
                position="absolute"
                bottom="10px"
                right="10px"
                colorScheme="red"
                icon={<AddIcon />}
            />
        </>
    );
};

const NavigationInbox = () => {
    const { inboxes } = useProps();

    return (
        <VStack height="100%" position="relative">
            <VStack width="100%" overflowY="auto">
                <NavigationItem item={inboxes} />
            </VStack>
            <AddInbox />
        </VStack>
    );
};

export default NavigationInbox;
