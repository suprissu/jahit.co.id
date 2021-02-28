import React from "react";
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
import ContextProvider, { useProps } from "@utils/Context";
import UserPanels from "@components/admin/UserPanels";
import CategoryPanels from "@components/admin/CategoryPanels";
import CustomerTab from "@components/admin/CustomerTab";
import PartnerTab from "@components/admin/PartnerTab";
import CategoryTab from "@components/admin/CategoryTab";
import "semantic-ui-css/semantic.min.css";

export default function Dashboard() {
    const { categories, customer, partner } = useProps();

    return (
        <ChakraProvider>
            <HStack justifyContent="space-between">
                <Heading marginY={3}> Dashboard</Heading>
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
                    <Tab>Pelanggan</Tab>
                    <Tab>Vendor</Tab>
                    <Tab>Proyek</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel padding="0px">
                        <UserPanels data={customer} CustomTab={CustomerTab} />
                    </TabPanel>
                    <TabPanel padding="0px">
                        <UserPanels data={partner} CustomTab={PartnerTab} />
                    </TabPanel>
                    <TabPanel padding="0px">
                        <CategoryPanels
                            data={categories}
                            CustomTab={CategoryTab}
                        />
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </ChakraProvider>
    );
}

const DashboardApp = props => {
    return (
        <ContextProvider {...props}>
            <Dashboard />
        </ContextProvider>
    );
};

const root = document.getElementById("admin-dashboard");
if (root) {
    const props = window.props;
    ReactDOM.render(<DashboardApp {...props} />, root);
}
