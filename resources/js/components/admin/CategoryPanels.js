import React, { useEffect, useState } from "react";
import {
    Center,
    Tabs,
    TabList,
    Tab,
    TabPanels,
    TabPanel,
    HStack,
    VStack,
    Box
} from "@chakra-ui/react";
import CustomTabs from "@components/tablist/CustomTabs";
import { usePanelType, useMobile } from "@utils/Context";
import { PROJECT_SENT } from "@utils/Constants";

const CategoryPanels = ({ data, CustomTab }) => {
    const { selectedType, setSelectedType } = usePanelType();
    const { isMobile } = useMobile();
    const [selectedCategory, setSelectedCategory] = useState(null);
    const [tabData, setTabData] = useState(null);

    useEffect(() => {
        setSelectedType("UNFINISHED");
        setSelectedCategory(data[0].name);
    }, []);

    useEffect(() => {
        if (selectedType && selectedCategory) filterTabData(data);
    }, [selectedType, selectedCategory]);

    const filterTabData = item => {
        const category = item.find(({ name }) => name === selectedCategory);
        const temp =
            selectedType === "FINISHED"
                ? category.projects.filter(
                      ({ status }) => status === PROJECT_SENT
                  )
                : category.projects.filter(
                      ({ status }) => status !== PROJECT_SENT
                  );
        setTabData(temp);
    };

    if (tabData === null) return null;

    return (
        <HStack alignItems="start">
            <Tabs variant="soft-rounded" colorScheme="red" flex="1">
                <TabList
                    position="sticky"
                    top="98px"
                    left="0"
                    right="0"
                    zIndex="998"
                    backgroundColor="white"
                    boxShadow="lg"
                    rounded="md"
                    padding={4}
                    overflowX="auto"
                >
                    <Tab
                        onClick={() => setSelectedType("UNFINISHED")}
                        paddingY="0px"
                    >
                        Belum Selesai
                    </Tab>
                    <Tab
                        onClick={() => setSelectedType("FINISHED")}
                        paddingY="0px"
                    >
                        Selesai
                    </Tab>
                </TabList>
                <TabPanels>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs data={tabData} CustomTab={CustomTab} />
                    </TabPanel>
                    <TabPanel paddingX="0px" paddingBottom="4rem">
                        <CustomTabs data={tabData} CustomTab={CustomTab} />
                    </TabPanel>
                </TabPanels>
            </Tabs>
            {isMobile ? (
                <HStack
                    pt={4}
                    backgroundColor="white"
                    position="fixed"
                    bottom="62px"
                    left="0"
                    right="0"
                    zIndex="998"
                    marginInlineEnd="0.5rem"
                    boxShadow="lg"
                    rounded="md"
                    padding={4}
                    overflowX="auto"
                >
                    {data.map((category, index) => (
                        <Box
                            p={2}
                            width="100%"
                            whiteSpace="pre"
                            borderRadius="5px"
                            borderWidth="1px"
                            cursor="pointer"
                            bgColor={
                                category.name === selectedCategory
                                    ? "red.100"
                                    : "transparent"
                            }
                            fontWeight={
                                category.name === selectedCategory
                                    ? "bold"
                                    : "normal"
                            }
                            color={
                                category.name === selectedCategory
                                    ? "red.700"
                                    : "gray.500"
                            }
                            key={index}
                            onClick={() => setSelectedCategory(category.name)}
                        >
                            {category.name}
                        </Box>
                    ))}
                </HStack>
            ) : (
                <VStack
                    pt={4}
                    flex="0.4"
                    backgroundColor="white"
                    boxShadow="lg"
                    rounded="md"
                    padding={4}
                >
                    {data.map((category, index) => (
                        <Box
                            p={4}
                            width="100%"
                            borderRadius="5px"
                            borderWidth="1px"
                            cursor="pointer"
                            bgColor={
                                category.name === selectedCategory
                                    ? "red.100"
                                    : "transparent"
                            }
                            fontWeight={
                                category.name === selectedCategory
                                    ? "bold"
                                    : "normal"
                            }
                            color={
                                category.name === selectedCategory
                                    ? "red.700"
                                    : "gray.500"
                            }
                            key={index}
                            onClick={() => setSelectedCategory(category.name)}
                        >
                            {category.name}
                        </Box>
                    ))}
                </VStack>
            )}
        </HStack>
    );
};

export default CategoryPanels;
