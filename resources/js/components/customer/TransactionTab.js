import React, { useState } from "react";
import {
    Box,
    Heading,
    HStack,
    VStack,
    Divider,
    Image,
    Text,
    Button,
    useDisclosure,
    useClipboard
} from "@chakra-ui/react";
import CustomTag from "@components/tablist/CustomTag";
import { currencyFormat, dateFormat } from "@utils/helper";
import { useData } from "@utils/Context";
import {
    PAY_WAIT,
    PAY_FAIL,
    REKENING,
    PEMILIK_REKENING
} from "@utils/Constants";
import { URL_UPLOAD_PAYMENT_SLIP } from "@utils/Path";
import AlertDialog from "@components/dialog/AlertDialog";
import SendFileDialog from "@components/dialog/SendFileDialog";

const TransactionTab = function TransactionTab({ data }) {
    const { isOpen, onOpen, onClose } = useDisclosure();

    const rekeningCopy = () => {
        const { hasCopied, onCopy } = useClipboard(REKENING);
        return {
            rekeningHasCopied: hasCopied,
            rekeningOnCopy: onCopy
        };
    };

    const costCopy = () => {
        const { hasCopied, onCopy } = useClipboard(data.cost);
        return {
            costHasCopied: hasCopied,
            costOnCopy: onCopy
        };
    };
    const { rekeningHasCopied, rekeningOnCopy } = rekeningCopy();
    const { costHasCopied, costOnCopy } = costCopy();

    console.log(data);

    return (
        <Box padding={5} marginY={2} shadow="md" borderWidth="1px">
            <AlertDialog
                title="Memulai Pekerjaan"
                content={
                    <SendFileDialog
                        onClose={onClose}
                        path={URL_UPLOAD_PAYMENT_SLIP}
                        name="payment_slip_path"
                        content={
                            <VStack
                                borderWidth="1px"
                                borderRadius="10px"
                                bgColor="yellow.50"
                                borderColor="yellow.200"
                                alignItems="flex-start"
                                p={4}
                            >
                                <Text>
                                    Kirim Transaksi Pembayaran ke Nomor Rekening
                                    berikut.
                                </Text>
                                <HStack>
                                    <Text fontSize="xl" fontWeight="bold">
                                        {REKENING}
                                    </Text>
                                    <Text fontSize="sm">
                                        a.n. {PEMILIK_REKENING}
                                    </Text>
                                </HStack>
                                <Button size="xs" onClick={rekeningOnCopy}>
                                    {rekeningHasCopied ? "Disalin" : "Salin"}
                                </Button>
                                <Text>sebesar</Text>
                                <Text
                                    fontSize="xl"
                                    fontWeight="bold"
                                    color="orange"
                                >
                                    {currencyFormat(data.cost)}
                                </Text>
                                <Button size="xs" onClick={costOnCopy}>
                                    {costHasCopied ? "Disalin" : "Salin"}
                                </Button>
                            </VStack>
                        }
                        data={{
                            transactionID: data.id,
                            deadline: data.deadline
                        }}
                    />
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <HStack justifyContent="space-between">
                <Box display="flex" flexDir="column" alignItems="start">
                    <Text fontWeight="bold" fontSize="xs">
                        {data.type}
                    </Text>
                    <Text size="sm" fontSize="xs">
                        {dateFormat(data.created_at)}
                    </Text>
                </Box>
                <VStack alignItems="flex-end">
                    <CustomTag data={data} />
                </VStack>
            </HStack>
            <Divider my={2} />
            <HStack justifyContent="space-between">
                <HStack>
                    {data.images && data.images.length !== 0 ? (
                        <Image
                            boxSize="54px"
                            objectFit="cover"
                            borderRadius="5px"
                            src={data.images[0].path}
                            fallbackSrc="https://via.placeholder.com/54"
                            alt="preview"
                        />
                    ) : null}
                    <Box alignItems="start">
                        <Heading fontSize="md">{data.project.name}</Heading>
                        <Text fontSize="sm">{data.project.count} buah</Text>
                    </Box>
                </HStack>
            </HStack>
            <HStack mt={2} justifyContent="space-between">
                <Box alignItems="start">
                    <Text fontSize="sm">Total harga: </Text>
                    <Text color="orange" fontSize="sm">
                        {currencyFormat(data.cost ?? 0)}
                    </Text>
                </Box>
                {data.status === PAY_WAIT || data.status === PAY_FAIL ? (
                    <Button size="sm" onClick={onOpen}>
                        Unggah Bukti Pembayaran
                    </Button>
                ) : null}
                {data.mou ? (
                    <Button
                        as="a"
                        href={`/home/transaction/download/mou/${data.mou.id}`}
                        size="sm"
                        onClick={onOpen}
                    >
                        Unggah MOU
                    </Button>
                ) : null}
                {data.invoice ? (
                    <Button
                        as="a"
                        href={`/home/transaction/download/invoice/${data.invoice.id}`}
                        size="sm"
                        onClick={onOpen}
                    >
                        Unggah Invoice
                    </Button>
                ) : null}
            </HStack>
        </Box>
    );
};

export default TransactionTab;
