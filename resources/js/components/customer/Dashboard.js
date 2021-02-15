import React, { useContext, useEffect, useState } from "react";
import {
    ChakraProvider,
    Heading,
    Tabs,
    TabList,
    Tab,
    TabPanels,
    TabPanel,
    HStack,
    Button,
    VStack,
    Box,
    Divider,
    Image,
    Text,
    Badge
} from "@chakra-ui/react";
import ReactDOM from "react-dom";
import _ from "lodash";
import CustomPanels from "./CustomPanels";
import CustomAlert from "../CustomAlert";
import ContextProvider, { Context } from "../../utils/context";
import NormalInput from "../NormalInput";
import { currencyFormat, dateFormat } from "../../utils/helper";
import CustomTag from "./CustomTag";

const ProjectForm = ({ data }) => {
    const [project, setProject] = useState(null);

    const [id, setId] = useState(null);
    const [name, setName] = useState("");
    const [address, setAddress] = useState("");
    const [categoryId, setCategoryId] = useState("");
    const [count, setCount] = useState("");
    const [cost, setCost] = useState("");
    const [createdAt, setCreatedAt] = useState("");
    const [customerId, setCustomerId] = useState("");
    const [deadline, setDeadline] = useState("");
    const [feedback, setFeedback] = useState("");
    const [note, setNote] = useState("");
    const [partnerId, setpartnerId] = useState("");
    const [rating, setRating] = useState("");
    const [startDate, setStartDate] = useState("");
    const [status, setStatus] = useState("");
    const [updatedAt, setUpdatedAt] = useState("");

    useEffect(() => {
        if (data !== null) {
            setProject(data);
            setId(data.id);
            setName(data.name);
            setStatus(data.status);
            setCategoryId(data.category_id);
            setCost(data.cost);
            setCount(data.count);
            setCreatedAt(data.created_at);
            setCustomerId(data.customer_id);
            setDeadline(data.deadline);
            setFeedback(data.feedback);
            setNote(data.note);
            setpartnerId(data.partner_id);
            setRating(data.rating);
            setStartDate(data.start_date);
            setStatus(data.status);
            setUpdatedAt(data.updated_at);
        }
    }, [data]);

    return (
        <VStack>
            <NormalInput
                title="Nama Proyek"
                placeholder="Masukkan nama proyek"
                name="name"
                type="text"
                isRequired={true}
                value={name}
                setValue={setName}
                disabled={data}
            />
            <NormalInput
                title="Kategori Proyek"
                placeholder="Masukkan kategori proyek"
                name="category"
                type="text"
                isRequired={true}
                value={name}
                setValue={setName}
                disabled={data}
            />
            <NormalInput
                title="Jumlah Pesanan"
                placeholder="Masukkan jumlah pesanan"
                name="count"
                type="number"
                isRequired={true}
                value={count}
                setValue={setCount}
                disabled={data}
            />
            <NormalInput
                title="Alamat"
                placeholder="Masukkan alamat"
                name="address"
                type="text"
                isRequired={true}
                value={address}
                setValue={setAddress}
                disabled={data}
            />
        </VStack>
    );
};

const PreviewImage = ({ images }) => {
    const [selectedImage, setSelectedImage] = useState("");

    useEffect(() => {
        setSelectedImage(images[0].path);
    }, []);

    return (
        <HStack width="100%" height="280px" justifyContent="center">
            <Image
                boxSize="280px"
                objectFit="cover"
                borderRadius="5px"
                src={selectedImage}
                fallbackSrc="https://via.placeholder.com/54"
                alt="preview"
            />
            <VStack
                overflowY="auto"
                justifyContent="flex-start"
                alignItems="flex-start"
                height="100%"
            >
                {images.map((data, index) => (
                    <Image
                        boxSize="92px"
                        objectFit="cover"
                        border={selectedImage === data.path ? "1px" : ""}
                        borderColor={
                            selectedImage === data.path ? "red.200" : ""
                        }
                        borderRadius="5px"
                        src={data.path}
                        key={index}
                        cursor="pointer"
                        onClick={() => setSelectedImage(data.path)}
                        fallbackSrc="https://via.placeholder.com/54"
                        alt="preview"
                    />
                ))}
            </VStack>
        </HStack>
    );
};

const ProjectDetail = ({ data }) => {
    return (
        <Box marginY={2}>
            <HStack justifyContent="space-between">
                <VStack alignItems="start">
                    <Text size="sm" fontSize="xs">
                        {dateFormat(data.created_at)}
                    </Text>
                </VStack>
                <VStack>
                    <CustomTag data={data} />
                </VStack>
            </HStack>
            <Divider my={2} />
            <PreviewImage images={data.images} />
            <Box my={4}>
                {data.cost ? (
                    <Text color="orange.400" fontSize="lg">
                        {currencyFormat(data.cost ?? 0)}
                    </Text>
                ) : null}
                <Heading fontSize="md">
                    {data.name} <Badge ml={1}>{data.id}</Badge>
                </Heading>
                <Text fontSize="sm">{data.count} buah</Text>
            </Box>
            <HStack mt={2} justifyContent="space-between">
                <Text fontSize="sm">Kategori </Text>
                <Text align="right" color="gray.400" fontSize="sm">
                    {data.category.name}
                </Text>
            </HStack>
            {data.partner ? (
                <HStack mt={2} justifyContent="space-between">
                    <Text fontSize="sm">Vendor </Text>
                    <Text align="right" color="gray.400" fontSize="sm">
                        {data.partner.company_name}
                    </Text>
                </HStack>
            ) : null}
            {data.startDate ? (
                <HStack mt={2} justifyContent="space-between">
                    <Text fontSize="sm">Mulai Pengerjaan </Text>
                    <Text align="right" color="gray.400" fontSize="sm">
                        {dateFormat(data.start_date)}
                    </Text>
                </HStack>
            ) : null}
            {data.deadline ? (
                <HStack mt={2} justifyContent="space-between">
                    <Text fontSize="sm">Selesai Pengerjaan </Text>
                    <Text align="right" color="gray.400" fontSize="sm">
                        {dateFormat(data.deadline)}
                    </Text>
                </HStack>
            ) : null}
            <HStack mt={2} justifyContent="space-between">
                <Text fontSize="sm">Alamat </Text>
                <Text align="right" color="gray.400" fontSize="sm">
                    {data.address}
                </Text>
            </HStack>
            <VStack mt={2} justifyContent="start" alignItems="start">
                <Text fontSize="sm">Catatan </Text>
                <Text
                    align="right"
                    color="gray.400"
                    fontSize="sm"
                    align="justify"
                >
                    {data.note}
                </Text>
            </VStack>
        </Box>
    );
};

export default function Dashboard({ projects, samples }) {
    const { isOpen, setIsOpen, selectedData, setSelectedData } = useContext(
        Context
    );

    const onClose = () => {
        setIsOpen(false);
        setSelectedData(null);
    };

    return (
        <ChakraProvider>
            <CustomAlert
                content={<ProjectDetail data={selectedData} />}
                isOpen={isOpen}
                onClose={onClose}
            />

            <HStack justifyContent="space-between">
                <Heading marginY={3}> Dashboard</Heading>
                <Button
                    colorScheme="red"
                    data-toggle="modal"
                    data-target="#addProject"
                >
                    Tambah Proyek
                </Button>
            </HStack>
            <Tabs isLazy isFitted colorScheme="red">
                <TabList
                    backgroundColor="white"
                    position="sticky"
                    top="56px"
                    left="0"
                    right="0"
                    zIndex="998"
                    boxShadow="lg"
                    borderTopRadius="md"
                >
                    <Tab>Proyek</Tab>
                    <Tab>Sample</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel padding="0px">
                        <CustomPanels data={projects} />
                    </TabPanel>
                    <TabPanel padding="0px">
                        <CustomPanels data={samples} />
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </ChakraProvider>
    );
}

const DashboardApp = props => {
    return (
        <ContextProvider>
            <Dashboard {...props} />
        </ContextProvider>
    );
};

const root = document.getElementById("projects");
if (root) {
    const props = window.props;
    ReactDOM.render(<DashboardApp {...props} />, root);
}
