import React, { useState, useEffect } from "react";
import {
    Heading,
    HStack,
    VStack,
    Box,
    Divider,
    Text,
    Badge,
    Button,
    useDisclosure
} from "@chakra-ui/react";
import AlertDialog from "@components/dialog/AlertDialog";
import CustomTag from "@components/tablist/CustomTag";
import PreviewImage from "@components/tablist/PreviewImage";
import ProjectForm from "@components/project/ProjectForm";
import CustomTabs from "@components/tablist/CustomTabs";
import ProjectTab from "@components/admin/ProjectTab";
import { useData } from "@utils/Context";
import { currencyFormat, dateFormat } from "@utils/helper";
import {
    URL_ADMIN_VERIF_PARTNER_ACTIVATE,
    URL_ADMIN_VERIF_PARTNER_DEACTIVATE
} from "@utils/Path";
import TemplateDialog from "@components/dialog/TemplateDialog";
import { PROJECT_SENT } from "@utils/Constants";
const ActivatePartner = ({ userID }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();

    return (
        <>
            <AlertDialog
                title={"Tolak Transaksi"}
                content={
                    <TemplateDialog
                        onClose={onClose}
                        method="POST"
                        data={{ userID }}
                        url={URL_ADMIN_VERIF_PARTNER_ACTIVATE}
                    />
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Button size="sm" colorScheme="teal" onClick={onOpen}>
                Aktifkan akun
            </Button>
        </>
    );
};

const DeactivatePartner = ({ userID }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();

    return (
        <>
            <AlertDialog
                title={"Tolak Transaksi"}
                content={
                    <TemplateDialog
                        onClose={onClose}
                        method="POST"
                        data={{ userID }}
                        url={URL_ADMIN_VERIF_PARTNER_DEACTIVATE}
                    />
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Button size="sm" colorScheme="red" onClick={onOpen}>
                Nonaktifkan akun
            </Button>
        </>
    );
};

const UserDetail = ({ data, editable }) => {
    const { selectedData } = useData();
    const { isOpen, onOpen, onClose } = useDisclosure();
    const [images, setImages] = useState([]);

    useEffect(() => {
        if (data.ktp_pict_link && data.npwp_pict_link) {
            setImages([
                { path: data.ktp_pict_link },
                { path: data.npwp_pict_link }
            ]);
        }
    }, [data]);

    if (!data.user) return null;

    return (
        <Box marginY={2}>
            <HStack justifyContent="space-between">
                <VStack alignItems="start">
                    <Text size="sm" fontSize="xs">
                        {dateFormat(data.created_at)}
                    </Text>
                    {data.user && (
                        <Badge
                            colorScheme={data.user.is_active ? "teal" : "gray"}
                        >
                            {data.user.is_active ? "Aktif" : "Belum Aktif"}
                        </Badge>
                    )}
                </VStack>
                <VStack alignItems="start">
                    {data.user && data.user.is_active ? (
                        <DeactivatePartner userID={data.user.id} />
                    ) : (
                        <ActivatePartner userID={data.user.id} />
                    )}
                </VStack>
            </HStack>
            <Divider my={2} />
            {images.length !== 0 && <PreviewImage images={images} />}
            <Box my={4}>
                {data.cost ? (
                    <Text color="orange.400" fontSize="lg">
                        {currencyFormat(data.cost ?? 0)}
                    </Text>
                ) : null}
                <Heading fontSize="md">
                    {data.user.name}{" "}
                    {data.user && <Badge ml={1}>{data.user.id}</Badge>}
                </Heading>
                <Text fontSize="sm">{data.phone_number}</Text>
                {data.user && <Text fontSize="sm">{data.user.email}</Text>}
            </Box>
            <HStack mt={2} justifyContent="space-between">
                <Text fontSize="sm">Perusahaan </Text>
                <Text align="right" color="gray.400" fontSize="sm">
                    {data.company_name}
                </Text>
            </HStack>
            {data.projects && (
                <VStack mt={2} alignItems="start">
                    <Text fontSize="sm">Proyek </Text>
                    <CustomTabs data={data.projects} CustomTab={ProjectTab} />
                </VStack>
            )}
        </Box>
    );
};

export default UserDetail;
