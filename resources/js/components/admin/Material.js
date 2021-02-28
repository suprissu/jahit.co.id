import React, { useContext, useEffect, useState } from "react";
import {
    ChakraProvider,
    Heading,
    Tabs,
    TabList,
    Tab,
    TabPanels,
    TabPanel,
    HStack
} from "@chakra-ui/react";
import ReactDOM from "react-dom";
import MaterialTab from "@components/admin/MaterialTab";
import CustomTabs from "@components/tablist/CustomTabs";
import ContextProvider, { useProps } from "@utils/Context";
import {
    MATERIAL_REQUESTED,
    MATERIAL_APPROVED,
    MATERIAL_REJECTED,
    MATERIAL_SENT
} from "@utils/Constants";
import "semantic-ui-css/semantic.min.css";
import { usePanelType } from "../../utils/Context";

export default function Material() {
    const {
        requestsRequested,
        requestsApproved,
        requestsSent,
        requestsRejected
    } = useProps();

    const { setSelectedType } = usePanelType();

    useEffect(() => {
        setSelectedType(MATERIAL_REQUESTED);
    }, []);

    return (
        <ChakraProvider>
            <HStack justifyContent="space-between">
                <Heading marginY={3}>Bahan</Heading>
            </HStack>
            <Tabs isLazy isFitted colorScheme="red">
                <TabList
                    backgroundColor="white"
                    position="sticky"
                    top="56px"
                    left="0"
                    right="0"
                    zIndex="998"
                    boxShadow="lg"
                    borderTopRadius="md"
                >
                    <Tab onClick={() => setSelectedType(MATERIAL_REQUESTED)}>
                        Menunggu Verifikasi
                    </Tab>
                    <Tab onClick={() => setSelectedType(MATERIAL_APPROVED)}>
                        Disetujui
                    </Tab>
                    <Tab onClick={() => setSelectedType(MATERIAL_SENT)}>
                        Dikirim
                    </Tab>
                    <Tab onClick={() => setSelectedType(MATERIAL_REJECTED)}>
                        Ditolak
                    </Tab>
                </TabList>
                <TabPanels>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs
                            data={requestsRequested}
                            CustomTab={MaterialTab}
                        />
                    </TabPanel>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs
                            data={requestsApproved}
                            CustomTab={MaterialTab}
                        />
                    </TabPanel>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs
                            data={requestsSent}
                            CustomTab={MaterialTab}
                        />
                    </TabPanel>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs
                            data={requestsRejected}
                            CustomTab={MaterialTab}
                        />
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </ChakraProvider>
    );
}

const MaterialApp = props => {
    return (
        <ContextProvider {...props}>
            <Material />
        </ContextProvider>
    );
};

const root = document.getElementById("admin-material");
if (root) {
    const props = window.props;
    ReactDOM.render(<MaterialApp {...props} />, root);
}
