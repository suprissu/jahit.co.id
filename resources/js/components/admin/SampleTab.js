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
import { useData } from "@utils/Context";
import AlertDialog from "@components/dialog/AlertDialog";
import ProjectDetail from "@components/project/ProjectDetail";
import DropzonePreview from "@components/DropzonePreview";
import { SAMPLE_APPROVED } from "@utils/Constants";

const ShipmentReceipt = ({ sample }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();

    return (
        <>
            <AlertDialog
                title={"Resi Sampel"}
                content={
                    <DropzonePreview fluid paths={[sample.receipt.path]} />
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Button size="sm" onClick={onOpen}>
                Lihat Resi
            </Button>
        </>
    );
};

const SampleTab = ({ data }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const { selectedData, setSelectedData } = useData();

    return (
        <Box padding={5} marginY={2} shadow="md" borderWidth="1px">
            <AlertDialog
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
                        <Heading fontSize="md">
                            {data.transaction.project.name}
                        </Heading>
                        <Text fontSize="sm">
                            {data.transaction.project.count} buah
                        </Text>
                    </Box>
                </HStack>
                <HStack>
                    {data.status === SAMPLE_APPROVED && (
                        <ShipmentReceipt sample={data} />
                    )}
                </HStack>
            </HStack>
        </Box>
    );
};

export default SampleTab;
