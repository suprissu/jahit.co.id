import { Heading, useDisclosure, Text, Button } from "@chakra-ui/react";
import React, { useEffect, useState } from "react";
import { Card, Rating } from "semantic-ui-react";
import AlertDialog from "@components/dialog/AlertDialog";
import TemplateDialog from "@components/dialog/TemplateDialog";
import { useData, useProps } from "@utils/Context";
import { currencyFormat } from "@utils/helper";
import NormalInput from "@components/NormalInput";
import { URL_REVIEW_PROJECT } from "@utils/Path";

const ReviewChat = ({ data }) => {
    const { selectedData } = useData();
    const { userRole } = useProps();
    const { isOpen, onOpen, onClose } = useDisclosure();
    const { project } = selectedData;
    const [form, setForm] = useState(null);
    const [rating, setRating] = useState(null);
    const [feedback, setFeedback] = useState("");
    const [projectID, setProjectID] = useState(null);
    const [customerID, setCustomerID] = useState(null);
    const [partnerID, setPartnerID] = useState(null);
    const [inboxID, setInboxID] = useState(null);
    const [chatID, setChatID] = useState(null);

    useEffect(() => {
        setChatID(data.id);
        setInboxID(selectedData.id);
        setProjectID(selectedData.project_id);
        setCustomerID(selectedData.customer_id);
        setPartnerID(selectedData.partner_id);
        if (selectedData.project.rating) setRating(selectedData.project.rating);
        else setRating(0);
        if (selectedData.project.feedback)
            setFeedback(selectedData.project.feedback);
    }, []);

    useEffect(() => {
        setForm({
            projectID,
            customerID,
            partnerID,
            inboxID,
            chatID,
            rating,
            feedback
        });
    }, [rating, feedback]);

    return (
        <Card.Group style={{ width: "100%", margin: "0px" }}>
            <AlertDialog
                title="Review Proyek"
                content={
                    <TemplateDialog
                        method="POST"
                        data={form}
                        selectedData={selectedData}
                        onClose={onClose}
                        url={URL_REVIEW_PROJECT}
                    />
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Card style={{ width: "100%", margin: "0px" }}>
                <Card.Content>
                    <Card.Header>
                        <Text color="orange">
                            {currencyFormat(project.cost)}
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
                        {userRole === "CLIENT" ? (
                            <Text>
                                Berikan rating kamu terhadap proyek ini ? Apakah
                                hasil yang diberikan vendor kami sudah cukup
                                memuaskan ?
                            </Text>
                        ) : (
                            <Text>
                                Berikut ini rating yang diberikan client kepada
                                kamu terhadap proyek ini. Harap dievaluasi
                                pekerjaannya ya !
                            </Text>
                        )}
                        {userRole === "CLIENT" ? (
                            <Rating
                                rating={rating}
                                maxRating={5}
                                onRate={(e, { rating }) => setRating(rating)}
                            />
                        ) : (
                            <Rating
                                disabled={true}
                                rating={rating}
                                maxRating={5}
                            />
                        )}
                        {userRole === "CLIENT" ? (
                            <NormalInput
                                isRequired={true}
                                title="Feedback"
                                name="feedback"
                                type="text"
                                value={feedback}
                                setValue={setFeedback}
                            />
                        ) : (
                            <Text>
                                {feedback || "Proyek ini belum direview."}
                            </Text>
                        )}
                    </Card.Description>
                </Card.Content>
                {userRole === "CLIENT" ? (
                    <Card.Content extra>
                        {!selectedData.project.rating ? (
                            <Button colorScheme="red" onClick={onOpen}>
                                Review Proyek
                            </Button>
                        ) : null}
                    </Card.Content>
                ) : null}
            </Card>
        </Card.Group>
    );
};

export default ReviewChat;
