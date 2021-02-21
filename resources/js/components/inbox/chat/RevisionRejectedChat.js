import React from "react";
import { VStack, Text } from "@chakra-ui/react";
import { useData } from "@utils/Context";

const RevisionRejectedChat = ({ data }) => {
    const { selectedData } = useData();
    const { excuse } = data;

    return (
        <VStack padding={3} alignItems="flex-start">
            <Text>
                Revisi Proyek
                <Text as="a" href={`/home/project/${selectedData.project_id}`}>
                    <strong>{selectedData.project.name}</strong> #
                    {selectedData.project_id}.
                </Text>{" "}
                ditolak dengan alasan {excuse}
            </Text>
        </VStack>
    );
};

export default RevisionRejectedChat;
