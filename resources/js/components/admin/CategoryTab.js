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
import CustomTag from "@components/tablist/CustomTag";
import { currencyFormat, dateFormat } from "@utils/helper";
import { URL_ADMIN_VERIF_PROJECT_PAY } from "@utils/Path";
import { useData, usePanelType } from "@utils/Context";
import ProjectDetail from "@components/project/ProjectDetail";
import AlertDialog from "@components/dialog/AlertDialog";
import TemplateDialog from "@components/dialog/TemplateDialog";
import DropzonePreview from "@components/DropzonePreview";
import { PROJECT_SENT } from "@utils/Constants";

const PayProject = ({ project }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();

    return (
        <>
            <AlertDialog
                title={"Bayar Proyek"}
                content={
                    <TemplateDialog
                        content={
                            project.receipt && (
                                <DropzonePreview
                                    fluid
                                    paths={[project.receipt.path]}
                                />
                            )
                        }
                        onClose={onClose}
                        method="POST"
                        data={{ projectID: project.id }}
                        url={URL_ADMIN_VERIF_PROJECT_PAY}
                    />
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Button size="sm" colorScheme="blue" onClick={onOpen}>
                Bayar Proyek
            </Button>
        </>
    );
};

const CategoryTab = ({ data }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const { selectedType } = usePanelType();
    const { selectedData, setSelectedData } = useData();

    return (
        <Box padding={5} marginY={2} shadow="md" borderWidth="1px">
            <AlertDialog
                content={<ProjectDetail data={selectedData} />}
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
                    <CustomTag status={data.status} deadline={data.deadline} />
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
                        {data.cost ? (
                            <Text color="orange" fontSize="sm">
                                {currencyFormat(data.cost ?? 0)}
                            </Text>
                        ) : null}
                        <Heading fontSize="md">{data.name}</Heading>
                        <Text fontSize="sm">{data.count} buah</Text>
                    </Box>
                </HStack>
                <HStack>
                    {data.status === PROJECT_SENT && (
                        <PayProject project={data} />
                    )}
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
            </HStack>
        </Box>
    );
};

export default CategoryTab;
