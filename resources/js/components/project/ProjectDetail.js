import React, { useContext } from "react";
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
import { useData } from "@utils/Context";
import { currencyFormat, dateFormat } from "@utils/helper";

const ProjectDetail = ({ data, editable }) => {
    const { selectedData } = useData();
    const { isOpen, onOpen, onClose } = useDisclosure();

    return (
        <Box marginY={2}>
            <HStack justifyContent="space-between">
                <VStack alignItems="start">
                    <Text size="sm" fontSize="xs">
                        {dateFormat(data.created_at)}
                    </Text>
                    <CustomTag status={data.status} deadline={data.deadline} />
                </VStack>
                <VStack>
                    {editable ? (
                        <>
                            <AlertDialog
                                content={
                                    <ProjectForm
                                        onClose={onClose}
                                        data={selectedData}
                                    />
                                }
                                isOpen={isOpen}
                                onClose={onClose}
                            />
                            <Button onClick={onOpen}>Ubah Proyek</Button>
                        </>
                    ) : null}
                </VStack>
            </HStack>
            <Divider my={2} />
            <PreviewImage images={data.images} />
            <Box my={4}>
                {data.cost ? (
                    <Text color="orange.400" fontSize="lg">
                        {currencyFormat(data.cost ?? 0)}
                    </Text>
                ) : null}
                <Heading fontSize="md">
                    {data.name} <Badge ml={1}>{data.id}</Badge>
                </Heading>
                <Text fontSize="sm">{data.count} buah</Text>
            </Box>
            <HStack mt={2} justifyContent="space-between">
                <Text fontSize="sm">Kategori </Text>
                <Text align="right" color="gray.400" fontSize="sm">
                    {data.category.name}
                </Text>
            </HStack>
            {data.partner ? (
                <HStack mt={2} justifyContent="space-between">
                    <Text fontSize="sm">Vendor </Text>
                    <Text align="right" color="gray.400" fontSize="sm">
                        {data.partner.company_name}
                    </Text>
                </HStack>
            ) : null}
            {data.start_date ? (
                <HStack mt={2} justifyContent="space-between">
                    <Text fontSize="sm">Mulai Pengerjaan </Text>
                    <Text align="right" color="gray.400" fontSize="sm">
                        {dateFormat(data.start_date)}
                    </Text>
                </HStack>
            ) : null}
            {data.deadline ? (
                <HStack mt={2} justifyContent="space-between">
                    <Text fontSize="sm">Selesai Pengerjaan </Text>
                    <Text align="right" color="gray.400" fontSize="sm">
                        {dateFormat(data.deadline)}
                    </Text>
                </HStack>
            ) : null}
            <HStack mt={2} justifyContent="space-between">
                <Text fontSize="sm">Alamat </Text>
                <Text align="right" color="gray.400" fontSize="sm">
                    {data.address}
                </Text>
            </HStack>
            <VStack mt={2} justifyContent="start" alignItems="start">
                <Text fontSize="sm">Catatan </Text>
                <Text
                    align="right"
                    color="gray.400"
                    fontSize="sm"
                    align="justify"
                >
                    {data.note}
                </Text>
            </VStack>
        </Box>
    );
};

export default ProjectDetail;
