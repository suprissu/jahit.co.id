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
import _ from "lodash";
import { useData } from "@utils/Context";
import { currencyFormat, dateFormat } from "@utils/helper";
import AlertDialog from "@components/dialog/AlertDialog";
import SendProjectDialog from "@components/dialog/SendFileDialog";
import TemplateDialog from "@components/dialog/TemplateDialog";
import CustomTag from "@components/tablist/CustomTag";
import ProjectDetail from "@components/project/ProjectDetail";
import {
    PROJECT_DP_OK,
    PROJECT_WORK_IN_PROGRESS,
    PROJECT_FULL_PAYMENT_OK,
    SAMPLE_PAYMENT_OK,
    SAMPLE_WORK_IN_PROGRESS,
    SAMPLE_FINISHED
} from "@utils/Constants";

const Action = ({ status, data }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();

    const actionStatus = stat => {
        const project = [
            PROJECT_DP_OK,
            PROJECT_WORK_IN_PROGRESS,
            PROJECT_FULL_PAYMENT_OK
        ];
        const sample = [
            SAMPLE_PAYMENT_OK,
            SAMPLE_WORK_IN_PROGRESS,
            SAMPLE_FINISHED
        ];

        const start = [PROJECT_DP_OK, SAMPLE_PAYMENT_OK];
        const finish = [PROJECT_WORK_IN_PROGRESS, SAMPLE_WORK_IN_PROGRESS];
        const send = [PROJECT_FULL_PAYMENT_OK, SAMPLE_FINISHED];

        const status = {
            type: null,
            action: ""
        };
        if (project.includes(stat)) {
            status.type = "project";
        } else if (sample.includes(stat)) {
            status.type = "sample";
        } else {
            status.type = null;
        }

        console.log(stat);

        if (start.includes(stat)) {
            status.action = "start";
        } else if (finish.includes(stat)) {
            status.action = "finish";
        } else if (send.includes(stat)) {
            status.action = "send";
        } else {
            status.action = null;
        }

        return status;
    };

    const colorScheme = stat => {
        if (stat === "start") return "yellow";
        else if (stat === "finish") return "teal";
        else if (stat === "send") return "blue";
        else return null;
    };

    const buttonText = stat => {
        if (stat === "start") return "Mulai Kerjakan";
        else if (stat === "finish") return "Selesaikan";
        else if (stat === "send") return "Kirimkan";
        else return null;
    };

    console.log(actionStatus(status).action);

    if (actionStatus(status).type !== null)
        return (
            <Box>
                <Button
                    colorScheme={colorScheme(actionStatus(status).action)}
                    onClick={onOpen}
                    size="sm"
                >
                    {buttonText(actionStatus(status).action)}
                </Button>
                <AlertDialog
                    title={buttonText(actionStatus(status).action) + " Proyek"}
                    content={
                        actionStatus(status).action === "send" ? (
                            <SendProjectDialog
                                onClose={onClose}
                                path={`/home/${actionStatus(status).type}/${
                                    actionStatus(status).action
                                }/${data.id}`}
                                name="shipment_receipt_path"
                            />
                        ) : (
                            <TemplateDialog
                                onClose={onClose}
                                method="POST"
                                url={`/home/${actionStatus(status).type}/${
                                    actionStatus(status).action
                                }/${data.id}`}
                            />
                        )
                    }
                    isOpen={isOpen}
                    onClose={onClose}
                />
            </Box>
        );
    else return null;
};

const SampleTab = ({ data }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const { selectedData, setSelectedData } = useData();

    console.log(data);

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
                    <CustomTag
                        status={data.sample.status}
                        deadline={data.deadline}
                    />
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
                        <Heading fontSize="md">{data.project.name}</Heading>
                        <Text fontSize="sm">{data.project.count} buah</Text>
                    </Box>
                </HStack>
            </HStack>
            <HStack mt={2} justifyContent="space-between">
                <Box alignItems="start">
                    <Text fontSize="sm">Total harga: </Text>
                    <Text color="orange" fontSize="sm">
                        {currencyFormat(data.cost ?? 0)}
                    </Text>
                </Box>
                <HStack>
                    <Action status={data.sample.status} data={data.sample} />
                </HStack>
            </HStack>
        </Box>
    );
};

export default SampleTab;
