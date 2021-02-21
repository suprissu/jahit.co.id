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
    useDisclosure
} from "@chakra-ui/react";
import ReactDOM from "react-dom";
import _ from "lodash";
import CustomerTab from "@components/customer/CustomerTab";
import AlertDialog from "@components/dialog/AlertDialog";
import CustomPanels from "@components/tablist/CustomPanels";
import ProjectForm from "@components/project/ProjectForm";
import ContextProvider, { useData, useProps } from "@utils/Context";
import "semantic-ui-css/semantic.min.css";

export default function Dashboard() {
    const { projects, samples } = useProps();
    const { selectedData, setSelectedData } = useData();

    const { isOpen, onOpen, onClose } = useDisclosure();

    const modalClose = () => {
        onClose();
    };

    return (
        <ChakraProvider>
            <AlertDialog
                content={<ProjectForm data={selectedData} />}
                isOpen={isOpen}
                onClose={modalClose}
            />

            <HStack justifyContent="space-between">
                <Heading marginY={3}> Dashboard</Heading>
                <Button
                    colorScheme="red"
                    onClick={() => {
                        onOpen();
                        setSelectedData(null);
                    }}
                >
                    Tambah Proyek
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
                    borderTopRadius="md"
                >
                    <Tab>Proyek</Tab>
                    <Tab>Sample</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel padding="0px">
                        <CustomPanels data={projects} CustomTab={CustomerTab} />
                    </TabPanel>
                    <TabPanel padding="0px">
                        <CustomPanels data={samples} CustomTab={CustomerTab} />
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

const root = document.getElementById("customer-projects");
if (root) {
    const props = window.props;
    ReactDOM.render(<DashboardApp {...props} />, root);
}
