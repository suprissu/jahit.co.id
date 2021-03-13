import React, { useContext, useEffect, useState } from "react";
import {
    ChakraProvider,
    Heading,
    Tabs,
    TabList,
    Tab,
    TabPanels,
    TabPanel,
    HStack,
    Button,
    Text,
    useDisclosure
} from "@chakra-ui/react";
import ReactDOM from "react-dom";
import TransactionTab from "@components/partner/TransactionTab";
import CustomTabs from "@components/tablist/CustomTabs";
import AlertDialog from "@components/dialog/AlertDialog";
import MaterialRequest from "@components/partner/MaterialRequest";
import ContextProvider, { useData, useProps } from "@utils/Context";
import "semantic-ui-css/semantic.min.css";

export default function Transaction() {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const {
        requestsAll,
        requestsRequested,
        requestsApproved,
        requestsSent,
        requestsRejected
    } = useProps();

    return (
        <ChakraProvider>
            <AlertDialog
                content={<MaterialRequest />}
                isOpen={isOpen}
                onClose={onClose}
            />
            <HStack justifyContent="space-between">
                <Heading marginY={3}>Bahan</Heading>
                <Button onClick={onOpen} colorScheme="red">
                    Minta Bahan
                </Button>
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
                    rounded="md"
                    padding={4}
                    overflowX="auto"
                >
                    <Tab>Semua</Tab>
                    <Tab>Diajukan</Tab>
                    <Tab>Disetujui</Tab>
                    <Tab>Dikirim</Tab>
                    <Tab>Dibatalkan</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs
                            data={requestsAll}
                            CustomTab={TransactionTab}
                        />
                    </TabPanel>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs
                            data={requestsRequested}
                            CustomTab={TransactionTab}
                        />
                    </TabPanel>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs
                            data={requestsApproved}
                            CustomTab={TransactionTab}
                        />
                    </TabPanel>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs
                            data={requestsSent}
                            CustomTab={TransactionTab}
                        />
                    </TabPanel>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs
                            data={requestsRejected}
                            CustomTab={TransactionTab}
                        />
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </ChakraProvider>
    );
}

const TransactionApp = props => {
    return (
        <ContextProvider {...props}>
            <Transaction />
        </ContextProvider>
    );
};

const root = document.getElementById("partner-transaction");
if (root) {
    const props = window.props;
    ReactDOM.render(<TransactionApp {...props} />, root);
}
