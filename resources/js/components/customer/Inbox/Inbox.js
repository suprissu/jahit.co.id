import React, { useEffect, useState } from "react";
import {
    ChakraProvider,
    HStack,
    Heading,
    Box,
    IconButton
} from "@chakra-ui/react";
import ReactDOM from "react-dom";
import _ from "lodash";
import ContextProvider, { useData, useMobile } from "../../../utils/Context";
import "semantic-ui-css/semantic.min.css";
import { ArrowBackIcon } from "@chakra-ui/icons";
import InboxContainer from "./InboxContainer";

export default function Inbox() {
    const { isMobile, setIsMobile } = useMobile();
    const { selectedData, setSelectedData } = useData();

    useEffect(() => {
        if (window.outerWidth < 767) {
            setIsMobile(true);
        } else {
            setIsMobile(false);
        }
        window.addEventListener("resize", e => {
            if (e.target.outerWidth < 767) {
                setIsMobile(true);
            } else {
                setIsMobile(false);
            }
        });
    }, []);

    if (isMobile === null) return null;

    return (
        <ChakraProvider>
            <HStack>
                {isMobile && selectedData ? (
                    <IconButton
                        onClick={() => setSelectedData(null)}
                        icon={<ArrowBackIcon />}
                    />
                ) : null}
                <Heading marginY={3}>Pesan</Heading>
            </HStack>
            <Box
                height="80vh"
                marginY={2}
                shadow="md"
                display="flex"
                flexDirection={isMobile ? "column" : "row"}
            >
                <InboxContainer />
            </Box>
        </ChakraProvider>
    );
}

const InboxApp = props => {
    return (
        <ContextProvider {...props}>
            <Inbox />
        </ContextProvider>
    );
};

const root = document.getElementById("customer-inbox");
if (root) {
    const props = window.props;
    ReactDOM.render(<InboxApp {...props} />, root);
}
