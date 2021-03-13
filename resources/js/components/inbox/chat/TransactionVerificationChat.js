import React from "react";
import { VStack, Text } from "@chakra-ui/react";
import { useData } from "@utils/Context";

const TransactionVerificationChat = ({ isSuccess }) => {
    const { selectedData } = useData();

    return (
        <VStack padding={3}>
            <Text textAlign="center">
                Transaksi{" "}
                <Text
                    as="a"
                    href={`/home/transaction/${selectedData.transaction.id}`}
                >
                    #{selectedData.transaction.id}
                </Text>{" "}
                {isSuccess ? "telah" : "gagal"} diverifikasi.
            </Text>
        </VStack>
    );
};

export default TransactionVerificationChat;
