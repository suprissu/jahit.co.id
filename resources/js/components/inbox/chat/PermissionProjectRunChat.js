import { Heading, HStack, useDisclosure, Text, Badge } from "@chakra-ui/react";
import React, { useState } from "react";
import { Button, Card } from "semantic-ui-react";
import AlertDialog from "@components/dialog/AlertDialog";
import PermissionDialog from "@components/dialog/PermissionDialog";
import { useData } from "@utils/Context";
import { currencyFormat } from "@utils/helper";
import { URL_SAMPLE_DEAL, URL_SAMPLE_REQUEST } from "@utils/Path";

const PermissionProjectRunChat = ({ data }) => {
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
                        <PermissionDialog
                            data={data}
                            selectedData={selectedData}
                            onClose={onClose}
                            path={URL_SAMPLE_DEAL}
                        />
                    ) : (
                        <PermissionDialog
                            data={data}
                            selectedData={selectedData}
                            onClose={onClose}
                            path={URL_SAMPLE_REQUEST}
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
                        Apakah kamu ingin <strong>menjalankan</strong> proyek
                        atau <strong>meminta sample</strong> terlebih dahulu?
                    </Card.Description>
                </Card.Content>
                <Card.Content extra>
                    {data.answer ? (
                        <Badge
                            colorScheme={
                                data.answer === "deal" ? "teal" : "red"
                            }
                        >
                            {data.answer === "deal"
                                ? "Dijalankan"
                                : "Meminta Sample"}
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
                                Minta Sample
                            </Button>
                            <Button
                                onClick={() => {
                                    setStatus("accept");
                                    onOpen();
                                }}
                                basic
                                color="green"
                            >
                                Jalankan Proyek
                            </Button>
                        </div>
                    )}
                </Card.Content>
            </Card>
        </Card.Group>
    );
};

export default PermissionProjectRunChat;
