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
import _ from "lodash";
import {
    PROJECT_DP_OK,
    PROJECT_WORK_IN_PROGRESS,
    PROJECT_FULL_PAYMENT_OK,
    SAMPLE_PAYMENT_OK,
    SAMPLE_WORK_IN_PROGRESS,
    SAMPLE_FINISHED
} from "../../utils/Constants";
import SendProjectDialog from "../SendFileDialog";
import ConfirmationDialog from "../ConfirmationDialog";

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
                <CustomAlert
                    title="Memulai Pekerjaan"
                    content={
                        actionStatus(status).action === "send" ? (
                            <SendProjectDialog
                                onClose={onClose}
                                path={`/home/${actionStatus(status).type}/${
                                    actionStatus(status).action
                                }/${data.id}`}
                            />
                        ) : (
                            <ConfirmationDialog
                                onClose={onClose}
                                method="GET"
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

const CustomTab = function CustomTab({ data }) {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const { selectedData, setSelectedData } = useData();
    return (
        <Box padding={5} marginY={2} shadow="md" borderWidth="1px">
            <CustomAlert
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
            </HStack>
            <HStack mt={2} justifyContent="space-between">
                <Box alignItems="start">
                    <Text fontSize="sm">Total harga: </Text>
                    <Text color="orange" fontSize="sm">
                        {currencyFormat(data.cost ?? 0)}
                    </Text>
                </Box>
                <HStack>
                    <Action status={data.status} data={data} />
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

export default CustomTab;
