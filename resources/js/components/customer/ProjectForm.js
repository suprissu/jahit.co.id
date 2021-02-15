import React, { useEffect, useState } from "react";
import {
    VStack,
    FormControl,
    FormLabel,
    HStack,
    Button
} from "@chakra-ui/react";
import NormalInput from "../NormalInput";
import { Dropdown } from "semantic-ui-react";
import { useProps } from "../../utils/CustomerContext";

const CategorySelect = ({
    placeholder,
    disabled,
    name,
    value,
    setValue,
    error,
    title,
    options
}) => {
    return (
        <FormControl
            id={name}
            pt={2}
            isInvalid={
                error !== undefined && error !== null && error.length > 0
            }
        >
            <FormLabel>{title}</FormLabel>
            <Dropdown
                placeholder={placeholder}
                fluid
                search
                selection
                name={name}
                value={value}
                onChange={(e, { value }) => {
                    setValue(value);
                }}
                disabled={disabled}
                options={options}
            />
        </FormControl>
    );
};

const ProjectForm = ({ data, onClose }) => {
    const { categories } = useProps();

    const categoryOptions = categories.map(data => {
        return {
            key: data.id,
            value: data.id,
            text: data.name
        };
    });

    const [id, setId] = useState(null);
    const [name, setName] = useState("");
    const [address, setAddress] = useState("");
    const [categoryId, setCategoryId] = useState("");
    const [count, setCount] = useState("");
    const [deadline, setDeadline] = useState("");
    const [note, setNote] = useState("");

    useEffect(() => {
        if (data !== null) {
            setId(data.id);
            setName(data.name);
            setCategoryId(data.category_id);
            setCount(data.count);
            setDeadline(data.deadline);
            setNote(data.note);
        }
    }, [data]);

    const isDisabled = data !== undefined && data !== null;

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
                disabled={isDisabled}
            />
            <CategorySelect
                name="category"
                title="Kategori Proyek"
                value={categoryId}
                setValue={setCategoryId}
                disabled={isDisabled}
                options={categoryOptions}
            />
            <NormalInput
                title="Jumlah Pesanan"
                placeholder="Masukkan jumlah pesanan"
                name="count"
                type="number"
                isRequired={true}
                value={count}
                setValue={setCount}
                disabled={isDisabled}
            />
            <NormalInput
                title="Alamat"
                placeholder="Masukkan alamat"
                name="address"
                type="text"
                isRequired={true}
                value={address}
                setValue={setAddress}
                disabled={isDisabled}
            />
            <NormalInput
                title="Selesai Pengerjaan"
                placeholder="Masukkan deadline"
                name="deadline"
                type="text"
                isRequired={true}
                value={deadline}
                setValue={setDeadline}
                disabled={isDisabled}
            />
            <NormalInput
                title="Catatan"
                placeholder="Masukkan catatan"
                name="note"
                type="text"
                isRequired={true}
                value={note}
                setValue={setNote}
                disabled={isDisabled}
            />
            <HStack width="100%" my={2} justifyContent="flex-end">
                <Button onClick={onClose}>Cancel</Button>
                <Button colorScheme="teal">Submit</Button>
            </HStack>
        </VStack>
    );
};

export default ProjectForm;
