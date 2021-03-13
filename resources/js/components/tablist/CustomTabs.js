import React from "react";
import { Center, Text } from "@chakra-ui/react";

const CustomTabs = function CustomTabs({ data, CustomTab }) {
    return data && data.length !== 0 ? (
        data.map((item, index) => <CustomTab data={item} key={index} />)
    ) : (
        <Center>
            <Text fontWeight="bold">Tidak ada item.</Text>
        </Center>
    );
};

export default CustomTabs;
