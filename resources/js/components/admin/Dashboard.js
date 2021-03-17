import React, { useEffect, useState } from "react";
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
import CustomTabs from "@components/tablist/CustomTabs";
import UserTab from "@components/admin/UserTab";
import CategoryTab from "@components/admin/CategoryTab";
import SampleTab from "@components/admin/SampleTab";
import "semantic-ui-css/semantic.min.css";

export default function Dashboard() {
    const { categories, customer, partner, samples } = useProps();
    const [categoriesCustom, setCategoriesCustom] = useState(null);

    useEffect(() => {
        const allProjects = [];
        categories.forEach(cat => {
            allProjects.push(...cat.projects);
        });
        const temp = [
            {
                id: 0,
                name: "Semua",
                projects: allProjects
            },
            ...categories
        ];
        setCategoriesCustom(temp);
    }, []);

    console.log(categoriesCustom);

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
                    <Tab>Sampel</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel paddingBottom="6rem">
                        <UserPanels data={customer} CustomTab={UserTab} />
                    </TabPanel>
                    <TabPanel paddingBottom="6rem">
                        <UserPanels data={partner} CustomTab={UserTab} />
                    </TabPanel>
                    <TabPanel paddingBottom="6rem">
                        <CategoryPanels
                            data={categoriesCustom}
                            CustomTab={CategoryTab}
                        />
                    </TabPanel>
                    <TabPanel paddingBottom="6rem">
                        <CustomTabs data={samples} CustomTab={SampleTab} />
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
