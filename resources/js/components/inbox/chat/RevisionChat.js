import {
    Heading,
    HStack,
    useDisclosure,
    Text,
    Badge,
    useProps
} from "@chakra-ui/react";
import React, { useState } from "react";
import { Button, Card } from "semantic-ui-react";
import AlertDialog from "@components/dialog/AlertDialog";
import RejectionDialog from "@components/dialog/RejectionDialog";
import AcceptNegotiationDialog from "@components/dialog/AcceptNegotiationDialog";
import { useData } from "@utils/Context";
import { currencyFormat, dateFormat } from "@utils/helper";
import { URL_REVISION_PURPOSE, URL_REVISION_REJECT } from "@utils/Path";

const RevisionChat = ({ data }) => {
    const { userRole } = useProps();
    const { selectedData } = useData();
    const { isOpen, onOpen, onClose } = useDisclosure();
    const [status, setStatus] = useState(null);
    const { project } = selectedData;
    const { negotiation } = data;

    return (
        <Card.Group style={{ width: "100%", margin: "0px" }}>
            <AlertDialog
                title={
                    status === "accept" ? "Menyetujui Proyek" : "Nego Proyek"
                }
                content={
                    status === "accept" ? (
                        <AcceptNegotiationDialog
                            data={data}
                            selectedData={selectedData}
                            onClose={onClose}
                            path={URL_REVISION_PURPOSE}
                        />
                    ) : (
                        <RejectionDialog
                            data={data}
                            onClose={onClose}
                            path={URL_REVISION_REJECT}
                        />
                    )
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Card style={{ width: "100%", margin: "0px" }}>
                <Card.Content>
                    <Card.Header>
                        <Text color="orange">
                            {currencyFormat(negotiation.cost)}
                        </Text>
                        <Text as="a" href={`/home/project/${project.id}`}>
                            <Heading as="h5" size="sm">
                                Revisi Proyek {project.name}
                            </Heading>
                        </Text>
                    </Card.Header>
                    <Card.Meta>
                        <Text as="a" href={`/home/project/${project.id}`}>
                            #{project.id}
                        </Text>
                    </Card.Meta>
                    <Card.Description>
                        <HStack
                            alignItems="flex-start"
                            justifyContent="space-between"
                        >
                            <Text color="black">Jumlah Pesanan</Text>
                            <Text>{negotiation.count}</Text>
                        </HStack>
                        <HStack
                            alignItems="flex-start"
                            justifyContent="space-between"
                        >
                            <Text color="black">Mulai Pengerjaan</Text>
                            <Text>{dateFormat(negotiation.start_date)}</Text>
                        </HStack>
                        <HStack
                            alignItems="flex-start"
                            justifyContent="space-between"
                        >
                            <Text color="black">Selesai Pengerjaan</Text>
                            <Text>{dateFormat(negotiation.deadline)}</Text>
                        </HStack>
                        <Text mt={4}></Text>
                    </Card.Description>
                </Card.Content>
                {userRole === "VENDOR" ? (
                    <Card.Content extra>
                        {data.answer ? (
                            <Badge
                                colorScheme={
                                    data.answer === "accept" ? "teal" : "red"
                                }
                            >
                                {data.answer === "accept"
                                    ? "Disetujui"
                                    : "Dinego"}
                            </Badge>
                        ) : (
                            <div className="ui two buttons">
                                <Button
                                    onClick={() => {
                                        setStatus("reject");
                                        onOpen();
                                    }}
                                    basic
                                    color="red"
                                >
                                    Tolak Revisi
                                </Button>
                                <Button
                                    onClick={() => {
                                        setStatus("accept");
                                        onOpen();
                                    }}
                                    basic
                                    color="green"
                                >
                                    Terima Revisi
                                </Button>
                            </div>
                        )}
                    </Card.Content>
                ) : null}
            </Card>
        </Card.Group>
    );
};

export default RevisionChat;
