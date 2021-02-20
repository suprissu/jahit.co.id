import { Heading, HStack, useDisclosure, Text, VStack } from "@chakra-ui/react";
import React, { useState } from "react";
import { Button, Card } from "semantic-ui-react";
import CustomAlert from "../../CustomAlert";
import { useData } from "../../../utils/Context";
import NegotiationDialog from "../../NegotiationDialog";
import RejectionDialog from "../../RejectionDialog";

const InitiationChat = ({ data, rejectPath, acceptPath }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const [status, setStatus] = useState(null);
    const { selectedData } = useData();
    const { project } = selectedData;

    return (
        <Card.Group>
            <CustomAlert
                title={
                    status === "accept" ? "Menyetujui Proyek" : "Menolak Proyek"
                }
                content={
                    status === "accept" ? (
                        <NegotiationDialog
                            data={data}
                            onClose={onClose}
                            acceptPath={acceptPath}
                        />
                    ) : (
                        <RejectionDialog
                            data={data}
                            onClose={onClose}
                            rejectPath={rejectPath}
                        />
                    )
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Card>
                <Card.Content>
                    <Card.Header>
                        <Heading as="h5" size="sm">
                            {project.name}
                        </Heading>
                    </Card.Header>
                    <Card.Meta>#{project.id}</Card.Meta>
                    <Card.Description>
                        <HStack justifyContent="space-between">
                            <Text color="black">Jumlah</Text>
                            <Text>{project.count}</Text>
                        </HStack>
                        <HStack justifyContent="space-between">
                            <Text color="black">Kategori</Text>
                            <Text>{project.category.name}</Text>
                        </HStack>
                        <VStack alignItems="flex-start">
                            <Text color="black">Catatan</Text>
                            <Text>{project.note}</Text>
                        </VStack>
                        <Text mt={4}></Text>
                    </Card.Description>
                </Card.Content>
                <Card.Content extra>
                    <div className="ui two buttons">
                        <Button
                            onClick={() => {
                                setStatus("reject");
                                onOpen();
                            }}
                            basic
                            color="red"
                        >
                            Decline
                        </Button>
                        <Button
                            onClick={() => {
                                setStatus("accept");
                                onOpen();
                            }}
                            basic
                            color="green"
                        >
                            Approve
                        </Button>
                    </div>
                </Card.Content>
            </Card>
        </Card.Group>
    );
};

export default InitiationChat;
