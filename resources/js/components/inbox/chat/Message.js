import React from "react";
import { Box } from "@chakra-ui/react";
import { useData, useProps } from "@utils/Context";
import InitiateNegotiationChat from "@components/inbox/chat/InitiateNegotiationChat";
import ProposeTextChat from "@components/inbox/chat/ProposeTextChat";
import NegotiationChat from "@components/inbox/chat/NegotiationChat";
import PermissionProjectRunChat from "@components/inbox/chat/PermissionProjectRunChat";
import DealTextChat from "@components/inbox/chat/DealTextChat";
import AskSampleChat from "@components/inbox/chat/AskSampleChat";
import DeliveredSampleChat from "@components/inbox/chat/DeliveredSampleChat";
import FinishedProjectChat from "@components/inbox/chat/FinishedProjectChat";
import TransactionVerificationChat from "@components/inbox/chat/TransactionVerificationChat";
import ReviewChat from "@components/inbox/chat/ReviewChat";
import RevisionChat from "@components/inbox/chat/RevisionChat";
import RevisionRejectedChat from "@components/inbox/chat/RevisionRejectedChat";

const ChatTemplate = ({ data }) => {
    const { selectedData } = useData();
    const { userRole } = useProps();
    const { type } = data;

    if (type === "INISIASI" && userRole === "VENDOR") {
        return (
            <InitiateNegotiationChat data={data} selectedData={selectedData} />
        );
    } else if (
        type === "DIAJUKAN" ||
        (type === "INISIASI" && userRole === "CLIENT")
    ) {
        return <ProposeTextChat data={data} />;
    } else if (type === "NEGOSIASI") {
        return <NegotiationChat data={data} />;
    } else if (type === "SETUJU") {
        return (
            <>
                <ProposeTextChat data={data} isAccepted={true} />
                {userRole === "CLIENT" ? (
                    <PermissionProjectRunChat data={data} />
                ) : null}
            </>
        );
    } else if (type === "DEAL") {
        return <DealTextChat />;
    } else if (type === "SAMPLE") {
        return <AskSampleChat />;
    } else if (type === "SAMPLE TERKIRIM") {
        return <DeliveredSampleChat data={data} />;
    } else if (type === "FINISH") {
        return <FinishedProjectChat />;
    } else if (type === "VERIFIKASI") {
        return <TransactionVerificationChat isSuccess={true} />;
    } else if (type === "VERIFIKASI DITOLAK") {
        return <TransactionVerificationChat isSuccess={false} />;
    } else if (type === "REVISI DIAJUKAN") {
        return <RevisionChat data={data} />;
    } else if (type === "REVISI DITOLAK") {
        return <RevisionRejectedChat data={data} />;
    } else if (type === "REVIEW") {
        return <ReviewChat data={data} />;
    } else {
        return null;
    }
};

const Chat = ({ data }) => {
    const { role } = data;
    const { userRole } = useProps();

    const alignRole = msgRole => {
        if (msgRole === "ADMIN") return "center";
        else if (msgRole === userRole) return "flex-end";
        else return "flex-start";
    };

    const bgColorRole = msgRole => {
        if (msgRole === "ADMIN") return "gray.200";
        else return "white";
    };

    return (
        <Box
            borderRadius="10px"
            minWidth="240px"
            maxWidth="80%"
            borderWidth="1px"
            bgColor={bgColorRole(role)}
            display="flex"
            flexDirection="column"
            alignSelf={alignRole(role)}
            alignItems={alignRole(role)}
        >
            <ChatTemplate data={data} />
        </Box>
    );
};

export default Chat;
