import React from "react";
import {
    ChakraProvider,
    Heading,
    Tabs,
    TabList,
    Tab,
    TabPanels,
    TabPanel
} from "@chakra-ui/react";
import ReactDOM from "react-dom";
import _ from "lodash";
import CustomPanels from "./CustomPanels";

export default function Projects({ projects, samples }) {
    return (
        <ChakraProvider>
            <Heading marginY={3}> Dashboard</Heading>
            <Tabs isLazy colorScheme="red">
                <TabList>
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

function customizer(value) {
    const temp = {};

    _.forEach(value, function(val, key) {
        temp[key] = JSON.parse(val.replace(/&quot;/g, '"'));
    });

    return temp;
}

const root = document.getElementById("projects");

if (root) {
    console.log("test");
    const props = _.mapValues(window.props, customizer);

    ReactDOM.render(<Projects {...props} />, root);
}
