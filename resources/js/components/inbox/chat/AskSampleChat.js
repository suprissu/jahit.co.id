import React from "react";
import { VStack, Text, Button } from "@chakra-ui/react";
import { useData, useProps } from "@utils/Context";
import { dateFormat } from "@utils/helper";

const AskSampleChat = ({ data }) => {
    const { selectedData } = useData();
    const { userRole } = useProps();

    console.log(selectedData);
    return (
        <VStack padding={3} alignItems="flex-start">
            {userRole === "CLIENT" ? (
                <Text>
                    Kamu telah mengajukan sample untuk Proyek{" "}
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
                    Client telah mengajukan sample untuk Proyek{" "}
                    {selectedData.project.count} buah{" "}
                    <Text
                        as="a"
                        href={`/home/project/${selectedData.project_id}`}
                    >
                        <strong>{selectedData.project.name}</strong> #
                        {selectedData.project_id}.
                    </Text>{" "}
                    Silahkan mulai kerjakan proyek ini dari tanggal{" "}
                    {dateFormat(data.negotiation.start_date)} sampai dengan
                    tanggal {dateFormat(data.negotiation.deadline)}{" "}
                    <strong>
                        setelah pembayaran telah diverifikasi oleh admin.
                    </strong>
                </Text>
            )}

            {userRole === "CLIENT" ? (
                <Button as="a" href={`/home/transaction`}>
                    Lihat Transaksi
                </Button>
            ) : null}
        </VStack>
    );
};

export default AskSampleChat;
