import React from "react";
import { VStack, Text, HStack } from "@chakra-ui/react";
import { useData } from "../../../utils/Context";
import { dateFormat } from "../../../utils/helper";

const ProposeTextChat = ({ data }) => {
    const { selectedData } = useData();

    return (
        <VStack borderWidth="1px" padding={3} alignItems="flex-start">
            <Text>
                Kamu telah mengajukan Proyek {selectedData.project.count} buah{" "}
                <strong>{selectedData.project.name}</strong>{" "}
                <Text as="a" href={`/home/project/${selectedData.project_id}`}>
                    #{selectedData.project_id}
                </Text>{" "}
            </Text>
            {data.negotiation ? (
                <>
                    <HStack width="100%" justifyContent="space-between">
                        <Text>Harga</Text>
                        <Text color="gray.400">{data.negotiation.cost}</Text>
                    </HStack>
                    <HStack width="100%" justifyContent="space-between">
                        <Text>Mulai Pengerjaan</Text>
                        <Text color="gray.400">
                            {dateFormat(data.negotiation.start_date)}
                        </Text>
                    </HStack>
                    <HStack width="100%" justifyContent="space-between">
                        <Text>Selesai Pengerjaan</Text>
                        <Text color="gray.400">
                            {dateFormat(data.negotiation.deadline)}
                        </Text>
                    </HStack>
                </>
            ) : null}
        </VStack>
    );
};

export default ProposeTextChat;
