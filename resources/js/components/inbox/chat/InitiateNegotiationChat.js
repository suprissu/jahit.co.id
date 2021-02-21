import { Heading, HStack, useDisclosure, Text, Badge } from "@chakra-ui/react";
import React, { useState } from "react";
import { Button, Card } from "semantic-ui-react";
import AlertDialog from "@components/dialog/AlertDialog";
import NegotiationDialog from "@components/dialog/NegotiationDialog";
import RejectionDialog from "@components/dialog/RejectionDialog";
import { URL_NEGO_OFFER, URL_NEGO_REJECT } from "@utils/Path";

const InitiationChat = ({ data, selectedData }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const [status, setStatus] = useState(null);
    const { project } = selectedData;

    return (
        <Card.Group style={{ width: "100%", margin: "0px" }}>
            <AlertDialog
                title={
                    status === "accept" ? "Menyetujui Proyek" : "Menolak Proyek"
                }
                content={
                    status === "accept" ? (
                        <NegotiationDialog
                            data={data}
                            selectedData={selectedData}
                            onClose={onClose}
                            path={URL_NEGO_OFFER}
                        />
                    ) : (
                        <RejectionDialog
                            data={data}
                            onClose={onClose}
                            path={URL_NEGO_REJECT}
                        />
                    )
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Card style={{ width: "100%", margin: "0px" }}>
                <Card.Content>
                    <Card.Header>
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
                            <Text color="black">Jumlah</Text>
                            <Text textAlign="right">{project.count}</Text>
                        </HStack>
                        <HStack
                            alignItems="flex-start"
                            justifyContent="space-between"
                        >
                            <Text color="black">Kategori</Text>
                            <Text textAlign="right">
                                {project.category.name}
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
                            {data.answer === "accept" ? "Diajukan" : "Ditolak"}
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
                                Tolak
                            </Button>
                            <Button
                                onClick={() => {
                                    setStatus("accept");
                                    onOpen();
                                }}
                                basic
                                color="green"
                            >
                                Ajukan
                            </Button>
                        </div>
                    )}
                </Card.Content>
            </Card>
        </Card.Group>
    );
};

export default InitiationChat;
