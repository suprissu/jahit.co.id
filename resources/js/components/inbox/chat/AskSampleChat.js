import React from "react";
import { VStack, Text, Button } from "@chakra-ui/react";
import { useData, useProps } from "@utils/Context";
import { dateFormat } from "@utils/helper";

const AskSampleChat = () => {
    const { selectedData } = useData();
    const { userRole } = useProps();

    return (
        <VStack borderWidth="1px" padding={3} alignItems="flex-start">
            {userRole === "CLIENT" ? (
                <Text>
                    Kamu telah mengajukan sample untuk Proyek
                    <Text
                        as="a"
                        href={`/home/project/${selectedData.project_id}`}
                    >
                        <strong>{selectedData.project.name}</strong> #
                        {selectedData.project_id}.
                    </Text>{" "}
                    Klik "Lihat Transaksi" untuk melihat detail transaksi.
                </Text>
            ) : (
                <Text>
                    Client telah menyetujui Proyek {selectedData.project.count}{" "}
                    buah{" "}
                    <Text
                        as="a"
                        href={`/home/project/${selectedData.project_id}`}
                    >
                        <strong>{selectedData.project.name}</strong> #
                        {selectedData.project_id}.
                    </Text>{" "}
                    Silahkan mulai kerjakan proyek ini dari tanggal{" "}
                    {dateFormat(selectedData.project.start_date)} sampai dengan
                    tanggal {dateFormat(selectedData.project.deadline)}.
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

export default AskSampleChat;
