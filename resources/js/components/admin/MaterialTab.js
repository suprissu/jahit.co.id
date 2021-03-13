import React, { useEffect, useState } from "react";
import {
    Box,
    Heading,
    HStack,
    Divider,
    Image,
    Text,
    Button,
    UnorderedList,
    ListItem,
    ListIcon,
    Badge,
    useDisclosure
} from "@chakra-ui/react";
import AlertDialog from "@components/dialog/AlertDialog";
import TemplateDialog from "@components/dialog/TemplateDialog";
import { dateFormat } from "@utils/helper";
import { useProps } from "@utils/Context";
import {
    MATERIAL_REQUESTED,
    MATERIAL_APPROVED,
    MATERIAL_SENT,
    MATERIAL_REJECTED
} from "@utils/Constants";
import { URL_ADMIN_VERIF_MATERIAL } from "@utils/Path";
import { usePanelType } from "../../utils/Context";

const SendComponent = ({ id }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();

    return (
        <>
            <AlertDialog
                title={"Kirim Bahan"}
                content={
                    <TemplateDialog
                        onClose={onClose}
                        method="POST"
                        data={{ materialRequestID: id, status: "SENT" }}
                        url={URL_ADMIN_VERIF_MATERIAL}
                    />
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Button onClick={onOpen} size="sm" colorScheme="blue">
                Kirim
            </Button>
        </>
    );
};

const AcceptComponent = ({ id }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();

    return (
        <>
            <AlertDialog
                title={"Setujui Transaksi"}
                content={
                    <TemplateDialog
                        onClose={onClose}
                        method="POST"
                        data={{ materialRequestID: id, status: "ACCEPT" }}
                        url={URL_ADMIN_VERIF_MATERIAL}
                    />
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Button onClick={onOpen} size="sm" colorScheme="teal">
                Setujui
            </Button>
        </>
    );
};

const RejectComponent = ({ id }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();

    return (
        <>
            <AlertDialog
                title={"Tolak Transaksi"}
                content={
                    <TemplateDialog
                        onClose={onClose}
                        method="POST"
                        data={{ materialRequestID: id, status: "REJECT" }}
                        url={URL_ADMIN_VERIF_MATERIAL}
                    />
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Button onClick={onOpen} size="sm" colorScheme="red">
                Tolak
            </Button>
        </>
    );
};

const MaterialItem = ({ data }) => {
    const { materials } = useProps();
    const material = materials.find(({ id }) => id === data.material_id);

    const colorSchemeStat = stat => {
        if (stat === MATERIAL_APPROVED) {
            return "teal";
        } else if (stat === MATERIAL_SENT) {
            return "blue";
        } else if (stat === MATERIAL_REJECTED) {
            return "red";
        } else {
            return "gray";
        }
    };

    return (
        <ListItem>
            <Box display="flex" alignItems="center">
                <Badge colorScheme={colorSchemeStat(data.status)}>
                    {data.status}
                </Badge>
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
            {data.status === MATERIAL_REQUESTED ? (
                <HStack mt={2}>
                    <RejectComponent id={data.id} />
                    <AcceptComponent id={data.id} />
                </HStack>
            ) : null}
            {data.status === MATERIAL_APPROVED ? (
                <HStack mt={2}>
                    <SendComponent id={data.id} />
                </HStack>
            ) : null}
        </ListItem>
    );
};

const MaterialTab = function MaterialTab({ data }) {
    const { selectedType } = usePanelType();

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
            <HStack justifyContent="space-between">
                <Box alignItems="start">
                    <Text fontSize="sm" fontWeight="bold">
                        Bahan:
                    </Text>
                    <UnorderedList>
                        {data.material_requests.map((data, index) => {
                            return data.status === selectedType ? (
                                <MaterialItem data={data} key={index} />
                            ) : null;
                        })}
                    </UnorderedList>
                </Box>
            </HStack>
        </Box>
    );
};

export default MaterialTab;
