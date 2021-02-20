import { Heading, HStack, useDisclosure, Text, Badge } from "@chakra-ui/react";
import React, { useState } from "react";
import { Button, Card } from "semantic-ui-react";
import CustomAlert from "../../CustomAlert";
import NegotiationDialog from "../../NegotiationDialog";
import AcceptNegotiationDialog from "../../AcceptNegotiationDialog";
import { useData } from "../../../utils/Context";

const NegotiationChat = ({ data }) => {
    const { selectedData } = useData();
    const { isOpen, onOpen, onClose } = useDisclosure();
    const [status, setStatus] = useState(null);
    const { project } = selectedData;

    return (
        <Card.Group style={{ margin: "0px" }}>
            <CustomAlert
                title={
                    status === "accept" ? "Menyetujui Proyek" : "Nego Proyek"
                }
                content={
                    status === "accept" ? (
                        <AcceptNegotiationDialog
                            data={data}
                            selectedData={selectedData}
                            onClose={onClose}
                            path="/home/inbox/nego/accept"
                        />
                    ) : (
                        <NegotiationDialog
                            data={data}
                            selectedData={selectedData}
                            onClose={onClose}
                            path="/home/inbox/nego/offer"
                        />
                    )
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Card>
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
                            <Text>{project.count}</Text>
                        </HStack>
                        <HStack
                            alignItems="flex-start"
                            justifyContent="space-between"
                        >
                            <Text color="black">Kategori</Text>
                            <Text>{project.category.name}</Text>
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
