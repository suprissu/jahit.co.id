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
import PermissionDialog from "@components/dialog/PermissionDialog";
import { useData } from "@utils/Context";
import { currencyFormat } from "@utils/helper";
import { URL_SAMPLE_REQUEST, URL_SAMPLE_DEAL } from "@utils/Path";

const DeliveredSampleChat = ({ data }) => {
    const { selectedData } = useData();
    const { userRole } = useProps();
    const { isOpen, onOpen, onClose } = useDisclosure();
    const [status, setStatus] = useState(null);
    const { project } = selectedData;
    const { negotiation } = data;

    return (
        <Card.Group style={{ margin: "0px" }}>
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
                            path={URL_SAMPLE_REQUEST}
                        />
                    ) : (
                        <PermissionDialog
                            data={data}
                            selectedData={selectedData}
                            onClose={onClose}
                            path={URL_SAMPLE_DEAL}
                        />
                    )
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Card>
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
                    {userRole === "CLIENT" ? (
                        <Card.Description>
                            Sample sudah dikirim! Apakah kamu ingin{" "}
                            <strong>menjalankan</strong> proyek atau{" "}
                            <strong>meminta sample</strong> lagi?
                        </Card.Description>
                    ) : (
                        <Card.Description>
                            Kamu telah mengirimkan sample! Tunggu tanggapan dari
                            client agar dapat melanjutkan proyek.
                        </Card.Description>
                    )}
                </Card.Content>
                {userRole === "CLIENT" ? (
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
                                    Minta Sample Lagi
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
                ) : null}
            </Card>
        </Card.Group>
    );
};

export default DeliveredSampleChat;
