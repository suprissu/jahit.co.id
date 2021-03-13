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
import TransactionTab from "@components/admin/TransactionTab";
import CustomTabs from "@components/tablist/CustomTabs";
import ContextProvider, { useData, useProps } from "@utils/Context";
import "semantic-ui-css/semantic.min.css";

export default function Transaction() {
    const {
        transactionsCheck,
        transactionsVerified,
        transactionsFailed
    } = useProps();

    return (
        <ChakraProvider>
            <HStack justifyContent="space-between">
                <Heading marginY={3}>Transaksi</Heading>
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
                    <Tab>Menunggu Verifikasi</Tab>
                    <Tab>Disetujui</Tab>
                    <Tab>Ditolak</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs
                            data={transactionsCheck}
                            CustomTab={TransactionTab}
                        />
                    </TabPanel>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs
                            data={transactionsVerified}
                            CustomTab={TransactionTab}
                        />
                    </TabPanel>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs
                            data={transactionsFailed}
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

const root = document.getElementById("admin-transaction");
if (root) {
    const props = window.props;
    ReactDOM.render(<TransactionApp {...props} />, root);
}
