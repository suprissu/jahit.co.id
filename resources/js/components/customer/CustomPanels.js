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
            <TabList
                backgroundColor="white"
                position="sticky"
                top="94px"
                left="0"
                right="0"
                zIndex="998"
                padding={4}
                overflowX="auto"
            >
                <Tab paddingY="0px">Semua</Tab>
                <Tab paddingY="0px">Pesanan</Tab>
                <Tab paddingY="0px">Dalam Pengerjaan</Tab>
                <Tab paddingY="0px">Selesai</Tab>
                <Tab>Batal</Tab>
            </TabList>
            <TabPanels>
                {Object.values(data).map((node, index) => (
                    <TabPanel paddingX="0px" paddingBottom="4rem" key={index}>
                        <CustomTabs type={node} />
                        <CustomTabs type={node} />
                        <CustomTabs type={node} />
                        <CustomTabs type={node} />
                        <CustomTabs type={node} />
                        <CustomTabs type={node} />
                        <CustomTabs type={node} />
                    </TabPanel>
                ))}
                ;
            </TabPanels>
        </Tabs>
    );
};

export default CustomPanels;
