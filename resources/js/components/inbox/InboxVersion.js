import React from "react";
import { Box } from "@chakra-ui/react";
import AdminInboxContainer from "@components/admin/InboxContainer";
import AdminNavigationInbox from "@components/admin/NavigationInbox";
import InboxContainer from "@components/inbox/InboxContainer";
import NavigationInbox from "@components/inbox/NavigationInbox";
import { useData, useMobile, useProps } from "@utils/Context";

const Container = () => {
    const { userRole } = useProps();

    if (userRole === "ADMIN") return <AdminInboxContainer />;
    else return <InboxContainer />;
};
const Navigation = () => {
    const { userRole } = useProps();
    if (userRole === "ADMIN") return <AdminNavigationInbox />;
    else return <NavigationInbox />;
};

const InboxMobileVersion = () => {
    const { selectedData } = useData();

    if (selectedData) return <Container />;
    else
        return (
            <Box height="100%" width="100%" padding={3} borderWidth="1px">
                <Navigation />
            </Box>
        );
};

const InboxDesktopVersion = () => {
    return (
        <>
            <Box height="100%" width="360px" padding={3} borderWidth="1px">
                <Navigation />
            </Box>
            <Container />
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
