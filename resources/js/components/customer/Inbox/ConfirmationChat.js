import { Heading, useDisclosure } from "@chakra-ui/react";
import React, { useState } from "react";
import { Button, Card } from "semantic-ui-react";
import CustomAlert from "../../CustomAlert";
import ConfirmationDialog from "../../ConfirmationDialog";
import NormalInput from "../../NormalInput";

const RejectionDialog = ({ id, onClose, rejectPath }) => {
    return <ConfirmationDialog onClose={onClose} url={rejectPath} />;
};

const NegotiationDialog = ({ id, onClose, acceptPath }) => {
    const [projectID, setProjectID] = useState(null);
    const [customerID, setCustomerID] = useState(null);
    const [partnerID, setPartnerID] = useState(null);
    const [inboxID, setInboxID] = useState(null);
    const [chatID, setChatID] = useState(null);

    return (
        <ConfirmationDialog
            content={<NormalInput />}
            onClose={onClose}
            url={acceptPath}
        />
    );
};

const ConfirmationChat = ({ id, title, content, rejectPath, acceptPath }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const [status, setStatus] = useState(null);

    return (
        <Card.Group>
            <CustomAlert
                title={
                    status === "accept" ? "Menyetujui Proyek" : "Menolak Proyek"
                }
                content={
                    status === "accept" ? (
                        <NegotiationDialog
                            onClose={onClose}
                            rejectPath={acceptPath}
                        />
                    ) : (
                        <RejectionDialog
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
                            {title}
                        </Heading>
                    </Card.Header>
                    <Card.Meta>#{id}</Card.Meta>
                    <Card.Description>{content}</Card.Description>
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

export default ConfirmationChat;
