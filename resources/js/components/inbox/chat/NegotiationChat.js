import { Heading, HStack, useDisclosure, Text, Badge } from "@chakra-ui/react";
import React, { useState } from "react";
import { Button, Card } from "semantic-ui-react";
import AlertDialog from "@components/dialog/AlertDialog";
import NegotiationDialog from "@components/dialog/NegotiationDialog";
import AcceptNegotiationDialog from "@components/dialog/AcceptNegotiationDialog";
import { useData } from "@utils/Context";
import { currencyFormat, dateFormat } from "@utils/helper";
import { URL_NEGO_ACCEPT, URL_NEGO_OFFER } from "@utils/Path";

const NegotiationChat = ({ data }) => {
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
                            path={URL_NEGO_ACCEPT}
                        />
                    ) : (
                        <NegotiationDialog
                            data={data}
                            selectedData={selectedData}
                            onClose={onClose}
                            path={URL_NEGO_OFFER}
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
                                {project.name}
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
                            <Text color="black">Mulai Pengerjaan</Text>
                            <Text textAlign="right">
                                {dateFormat(negotiation.start_date)}
                            </Text>
                        </HStack>
                        <HStack
                            alignItems="flex-start"
                            justifyContent="space-between"
                        >
                            <Text color="black">Selesai Pengerjaan</Text>
                            <Text textAlign="right">
                                {dateFormat(negotiation.deadline)}
                            </Text>
                        </HStack>
                        <Text mt={4}></Text>
                    </Card.Description>
                </Card.Content>
                <Card.Content extra>
                    {data.answer ? (
                        <Badge
                            colorScheme={
                                data.answer === "accept" ? "teal" : "red"
                            }
                        >
                            {data.answer === "accept" ? "Disetujui" : "Dinego"}
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
                                Nego
                            </Button>
                            <Button
                                onClick={() => {
                                    setStatus("accept");
                                    onOpen();
                                }}
                                basic
                                color="green"
                            >
                                Setuju
                            </Button>
                        </div>
                    )}
                </Card.Content>
            </Card>
        </Card.Group>
    );
};

export default NegotiationChat;
