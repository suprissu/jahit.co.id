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

const CustomPanels = ({ data, CustomTab }) => {
    return (
        <Tabs variant="soft-rounded" colorScheme="red">
            <TabList
                backgroundColor="white"
                position="sticky"
                top="98px"
                left="0"
                right="0"
                zIndex="998"
                boxShadow="lg"
                rounded="md"
                padding={4}
                overflowX="auto"
            >
                <Tab paddingY="0px">Semua</Tab>
                <Tab paddingY="0px">Pesanan</Tab>
                <Tab paddingY="0px">Dalam Pengerjaan</Tab>
                <Tab paddingY="0px">Selesai</Tab>
                <Tab paddingY="0px">Batal</Tab>
            </TabList>
            <TabPanels>
                {Object.values(data).map((node, index) => {
                    return (
                        <TabPanel
                            paddingX="0px"
                            paddingBottom="4rem"
                            key={index}
                        >
                            <CustomTabs data={node} CustomTab={CustomTab} />
                        </TabPanel>
                    );
                })}
                ;
            </TabPanels>
        </Tabs>
    );
};

export default CustomPanels;
