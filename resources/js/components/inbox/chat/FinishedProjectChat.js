import React from "react";
import { VStack, Text, Button } from "@chakra-ui/react";
import { useData, useProps } from "@utils/Context";

const FinishedProjectChat = () => {
    const { selectedData } = useData();
    const { userRole } = useProps();

    return (
        <VStack padding={3} alignItems="flex-start">
            {userRole === "CLIENT" ? (
                <Text>
                    Proyek {selectedData.project.count} buah{" "}
                    <Text
                        as="a"
                        href={`/home/project/${selectedData.project_id}`}
                    >
                        <strong>{selectedData.project.name}</strong> #
                        {selectedData.project_id}.
                    </Text>{" "}
                    sudah selesai dikerjakan. Klik "Lihat Transaksi" untuk
                    melihat detail transaksi pelunasan.
                </Text>
            ) : (
                <Text>
                    Kamu telah menyelesaikan Proyek {selectedData.project.count}{" "}
                    buah{" "}
                    <Text
                        as="a"
                        href={`/home/project/${selectedData.project_id}`}
                    >
                        <strong>{selectedData.project.name}</strong> #
                        {selectedData.project_id}.
                    </Text>
                    .
                </Text>
            )}

            {userRole === "CLIENT" ? (
                <Button
                    as="a"
                    href={`/home/transaction/${selectedData.transaction.id}`}
                >
                    Lihat Transaksi
                </Button>
            ) : null}
        </VStack>
    );
};

export default FinishedProjectChat;
