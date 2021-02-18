import React from "react";
import ChatContainer from "./ChatContainer";
import NavigationInbox from "./NavigationInbox";
import { useData, useMobile } from "../../../utils/Context";

const InboxMobileVersion = () => {
    const { selectedData } = useData();
    if (selectedData) return <ChatContainer />;
    else return <NavigationInbox />;
};

const InboxDesktopVersion = () => {
    return (
        <>
            <NavigationInbox />
            <ChatContainer />
        </>
    );
};

const InboxContainer = () => {
    const { isMobile } = useMobile();

    console.log(isMobile);
    if (isMobile) {
        return <InboxMobileVersion />;
    } else {
        return <InboxDesktopVersion />;
    }
};

export default InboxContainer;
