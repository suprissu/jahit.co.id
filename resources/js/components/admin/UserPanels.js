import React from "react";
import {
    Center,
    Tabs,
    TabList,
    Tab,
    TabPanels,
    TabPanel
} from "@chakra-ui/react";
import CustomTabs from "@components/tablist/CustomTabs";

const UserPanels = ({ data, CustomTab }) => {
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
                {data.map((item, index) => (
                    <Tab paddingY="0px" key={index}>
                        {item.name}
                    </Tab>
                ))}
            </TabList>
            <TabPanels>
                {data.map((item, index) => {
                    return (
                        <TabPanel
                            paddingX="0px"
                            paddingBottom="4rem"
                            key={index}
                        >
                            <CustomTabs
                                data={item.data}
                                CustomTab={CustomTab}
                            />
                        </TabPanel>
                    );
                })}
                ;
            </TabPanels>
        </Tabs>
    );
};

export default UserPanels;
