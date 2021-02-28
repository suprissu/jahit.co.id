import React, { useEffect, useState } from "react";
import {
    Box,
    Heading,
    HStack,
    Divider,
    Image,
    Text,
    Button,
    useDisclosure,
    VStack
} from "@chakra-ui/react";
import AlertDialog from "@components/dialog/AlertDialog";
import TemplateDialog from "@components/dialog/TemplateDialog";
import { currencyFormat, dateFormat } from "@utils/helper";
import { PAY_IN_VERIF, PAY_OK } from "@utils/Constants";
import { URL_ADMIN_VERIF_PAYMENT } from "@utils/Path";
import Dropzone from "@components/Dropzone";

const AcceptComponent = ({ id }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const [mou_path, setMouPath] = useState([]);
    const [invoice_path, setInvoicePath] = useState([]);
    const [form, setForm] = useState(null);

    useEffect(() => {
        const formData = new FormData();
        formData.append("transactionID", id);
        formData.append("status", "ACCEPT");
        mou_path.forEach(data => {
            formData.append("mou_path", data);
        });
        invoice_path.forEach(data => {
            formData.append("invoice_path", data);
        });
        setForm(formData);
    }, [mou_path, invoice_path]);

    return (
        <>
            <AlertDialog
                title={"Setujui Transaksi"}
                content={
                    <TemplateDialog
                        onClose={onClose}
                        method="POST"
                        content={
                            <VStack width="100%">
                                <Dropzone
                                    title="Upload MOU"
                                    name={name}
                                    value={mou_path}
                                    setValue={setMouPath}
                                    multiple={false}
                                    acceptedFiles=".pdf"
                                />
                                <Dropzone
                                    title="Upload Invoice"
                                    name={name}
                                    value={invoice_path}
                                    setValue={setInvoicePath}
                                    multiple={false}
                                    acceptedFiles=".pdf"
                                />
                            </VStack>
                        }
                        data={form}
                        url={URL_ADMIN_VERIF_PAYMENT}
                    />
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Button onClick={onOpen} size="sm" colorScheme="teal">
                Setujui
            </Button>
        </>
    );
};

const RejectComponent = ({ id }) => {
    const { isOpen, onOpen, onClose } = useDisclosure();

    return (
        <>
            <AlertDialog
                title={"Tolak Transaksi"}
                content={
                    <TemplateDialog
                        onClose={onClose}
                        method="POST"
                        data={{ transactionID: id, status: "REJECT" }}
                        url={URL_ADMIN_VERIF_PAYMENT}
                    />
                }
                isOpen={isOpen}
                onClose={onClose}
            />
            <Button onClick={onOpen} size="sm" colorScheme="red">
                Tolak
            </Button>
        </>
    );
};

const TransactionTab = function TransactionTab({ data }) {
    const [id, setId] = useState(null);

    useEffect(() => {
        console.log(data);
        setId(data.id);
    }, [data]);

    console.log(id);

    return (
        <Box padding={5} marginY={2} shadow="md" borderWidth="1px">
            <HStack justifyContent="space-between">
                <Text size="sm" fontSize="xs">
                    {dateFormat(data.created_at)}
                </Text>
                <Box alignItems="end">
                    <Text fontSize="sm">Total harga: </Text>
                    <Text color="orange" fontSize="sm">
                        {currencyFormat(data.cost ?? 0)}
                    </Text>
                </Box>
            </HStack>
            <Divider my={2} />
            <HStack justifyContent="space-between">
                <HStack>
                    {data.payment_slip ? (
                        <Image
                            boxSize="54px"
                            objectFit="cover"
                            borderRadius="5px"
                            src={data.payment_slip.path}
                            fallbackSrc="https://via.placeholder.com/54"
                            alt="preview"
                        />
                    ) : null}
                    <Box alignItems="start">
                        <Heading fontSize="md">{data.project.name}</Heading>
                        <Text fontSize="sm">{data.project.count} buah</Text>
                    </Box>
                </HStack>
                {data.status === PAY_IN_VERIF ? (
                    <HStack>
                        <RejectComponent id={id} />
                        <AcceptComponent id={id} />
                    </HStack>
                ) : null}
                {data.status === PAY_OK ? (
                    <HStack>
                        {data.mou ? (
                            <Button
                                as="a"
                                href={`/home/transaction/download/mou/${data.mou.id}`}
                                size="sm"
                            >
                                Unggah MOU
                            </Button>
                        ) : null}
                        {data.invoice ? (
                            <Button
                                as="a"
                                href={`/home/transaction/download/invoice/${data.invoice.id}`}
                                size="sm"
                            >
                                Unggah Invoice
                            </Button>
                        ) : null}
                    </HStack>
                ) : null}
            </HStack>
        </Box>
    );
};

export default TransactionTab;
