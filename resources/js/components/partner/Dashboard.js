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
import _ from "lodash";
import CustomPanels from "@components/tablist/CustomPanels";
import ContextProvider, { useProps } from "@utils/Context";
import PartnerTab from "@components/partner/PartnerTab";
import "semantic-ui-css/semantic.min.css";

export default function Dashboard() {
    const { projects, samples } = useProps();

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
                    <Tab>Proyek</Tab>
                    <Tab>Sample</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel padding="0px">
                        <CustomPanels
                            data={projects}
                            CustomTab={<PartnerTab />}
                        />
                    </TabPanel>
                    <TabPanel padding="0px">
                        <CustomPanels
                            data={samples}
                            CustomTab={<PartnerTab />}
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

const root = document.getElementById("partner-projects");
if (root) {
    const props = window.props;
    ReactDOM.render(<DashboardApp {...props} />, root);
}
