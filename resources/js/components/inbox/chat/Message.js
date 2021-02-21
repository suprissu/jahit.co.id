import React from "react";
import { Box } from "@chakra-ui/react";
import { useData, useProps } from "@utils/Context";
import InitiateNegotiationChat from "@components/inbox/chat/InitiateNegotiationChat";
import ProposeTextChat from "@components/inbox/chat/ProposeTextChat";
import NegotiationChat from "@components/inbox/chat/NegotiationChat";
import PermissionProjectRunChat from "@components/inbox/chat/PermissionProjectRunChat";
import DealTextChat from "@components/inbox/chat/DealTextChat";
import AskSampleChat from "@components/inbox/chat/AskSampleChat";

const ChatTemplate = ({ data }) => {
    const { selectedData } = useData();
    const { userRole } = useProps();
    const { type } = data;

    console.log(selectedData);

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

    return (
        <Box
            borderRadius="10px"
            width="80%"
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
