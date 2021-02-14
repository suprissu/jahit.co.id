import React from "react";
import {
    Center,
    Tabs,
    TabList,
    Tab,
    TabPanels,
    TabPanel
} from "@chakra-ui/react";
import CustomTabs from "./CustomTabs";

const CustomPanels = ({ data }) => {
    return (
        <Tabs variant="soft-rounded" colorScheme="red">
            <Center>
                <TabList padding={1} overflowX="auto">
                    <Tab paddingY="0px">Semua</Tab>
                    <Tab paddingY="0px">Pesanan</Tab>
                    <Tab paddingY="0px">Dalam Pengerjaan</Tab>
                    <Tab paddingY="0px">Selesai</Tab>
                    <Tab>Batal</Tab>
                </TabList>
            </Center>
            <TabPanels>
                {Object.values(data).map((node, index) => (
                    <TabPanel
                        paddingX="0px"
                        maxHeight="70vh"
                        overflowY="auto"
                        key={index}
                    >
                        <CustomTabs type={node} />
                    </TabPanel>
                ))}
                ;
            </TabPanels>
        </Tabs>
    );
};

export default CustomPanels;
