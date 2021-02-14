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
    VStack,
    VisuallyHidden
} from "@chakra-ui/react";
import ReactDOM from "react-dom";
import _ from "lodash";
import CustomPanels from "./CustomPanels";
import CustomAlert from "../CustomAlert";
import ContextProvider, { Context } from "../../utils/context";
import NormalInput from "../NormalInput";

const ProjectForm = ({ data }) => {
    const [project, setProject] = useState(null);

    const [projectId, setProjectId] = useState("");
    const [projectName, setProjectName] = useState("");

    useEffect(() => {
        setProject(data);
        setProjectId(data.id);
        setProjectName(data.name);
    }, [data]);

    console.log(project);

    return (
        <VStack>
            <VisuallyHidden>
                <NormalInput value={projectId} />
            </VisuallyHidden>
            <NormalInput
                title="Nama Proyek"
                placeholder="Masukkan nama proyek"
                name="name"
                type="text"
                isRequired={true}
                value={projectName}
                setValue={setProjectName}
                disabled={true}
            />
        </VStack>
    );
};

export default function Dashboard({ projects, samples }) {
    const {
        isOpen,
        setIsOpen,
        modalTitle,
        setModalTitle,
        selectedData,
        setSelectedData
    } = useContext(Context);

    const onClose = () => {
        setIsOpen(false);
        setSelectedData(null);
    };

    return (
        <ChakraProvider>
            <CustomAlert
                title={modalTitle}
                content={<ProjectForm data={selectedData} />}
                isOpen={isOpen}
                onClose={onClose}
            />

            <HStack justifyContent="space-between">
                <Heading marginY={3}> Dashboard</Heading>
                <Button
                    colorScheme="red"
                    onClick={() => {
                        setModalTitle("Tambah Proyek");
                        setIsOpen(true);
                    }}
                >
                    Tambah Proyek
                </Button>
            </HStack>
            <Tabs isLazy isFitted variant="enclosed" colorScheme="red">
                <TabList
                    backgroundColor="white"
                    position="sticky"
                    top="52px"
                    left="0"
                    right="0"
                    zIndex="998"
                >
                    <Tab>Proyek</Tab>
                    <Tab>Sample</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel paddingX="0px">
                        <CustomPanels data={projects} />
                    </TabPanel>
                    <TabPanel paddingX="0px">
                        <CustomPanels data={samples} />
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </ChakraProvider>
    );
}

const DashboardApp = props => {
    return (
        <ContextProvider>
            <Dashboard {...props} />
        </ContextProvider>
    );
};

function customizer(value) {
    const temp = {};

    _.forEach(value, function(val, key) {
        temp[key] = JSON.parse(val.replace(/&quot;/g, '"'));
    });

    return temp;
}

const root = document.getElementById("projects");

if (root) {
    const props = _.mapValues(window.props, customizer);

    ReactDOM.render(<DashboardApp {...props} />, root);
}
