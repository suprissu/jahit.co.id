import React from "react";
import { Box } from "@chakra-ui/react";
import InboxContainer from "@components/inbox/InboxContainer";
import NavigationInbox from "@components/inbox/NavigationInbox";
import { useData, useMobile } from "@utils/Context";

const InboxMobileVersion = () => {
    const { selectedData } = useData();
    if (selectedData) return <InboxContainer />;
    else
        return (
            <Box height="100%" width="100%" padding={3} borderWidth="1px">
                <NavigationInbox />
            </Box>
        );
};

const InboxDesktopVersion = () => {
    return (
        <>
            <Box height="100%" width="360px" padding={3} borderWidth="1px">
                <NavigationInbox />
            </Box>
            <InboxContainer />
        </>
    );
};

const InboxVersion = () => {
    const { isMobile } = useMobile();

    if (isMobile) {
        return <InboxMobileVersion />;
    } else {
        return <InboxDesktopVersion />;
    }
};

export default InboxVersion;
