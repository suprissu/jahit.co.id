import React from "react";
import { Center, Text } from "@chakra-ui/react";
import CustomTab from "./CustomTab";

const CustomTabs = function CustomTabs({ type }) {
    console.log(type);
    return type && type.length !== 0 ? (
        type.map((data, index) => <CustomTab data={data} key={index} />)
    ) : (
        <Center>
            <Text fontWeight="bold">Tidak ada item.</Text>
        </Center>
    );
};

export default CustomTabs;
