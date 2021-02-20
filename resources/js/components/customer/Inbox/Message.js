import React from "react";
import { Box } from "@chakra-ui/react";
import { useData, useProps } from "../../../utils/Context";
import InitiateNegotiationChat from "../../InitiateNegotiationChat";
import ProposeTextChat from "./ProposeTextChat";
import NegotiationChat from "./NegotiationChat";

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
    } else {
        return <ProposeTextChat data={data} />;
    }
};

const Chat = ({ data }) => {
    const { role } = data;
    const { userRole } = useProps();

    console.log(userRole);

    const alignRole = msgRole => {
        if (msgRole === "ADMIN") return "center";
        else if (msgRole === userRole) return "flex-end";
        else return "flex-start";
    };

    const bgColorRole = msgRole => {
        if (msgRole === "ADMIN") return "gray.200";
        else if (msgRole === userRole) return "red.500";
        else return "white";
    };

    const colorRole = msgRole => {
        if (msgRole === userRole) return "white";
        else return "black";
    };

    return (
        <Box width="60%" alignSelf={alignRole(role)}>
            <ChatTemplate data={data} />
        </Box>
    );
};

export default Chat;
