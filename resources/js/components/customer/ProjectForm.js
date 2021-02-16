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
import Dropzone from "../Dropzone";
import { useProps } from "../../utils/CustomerContext";
import axios from "axios";

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
    const [category, setCategory] = useState("");
    const [count, setCount] = useState("");
    const [note, setNote] = useState("");
    const [picture, setPicture] = useState([]);

    useEffect(() => {
        if (data !== null) {
            setId(data.id);
            setName(data.name);
            setCategory(data.category_id);
            setCount(data.count);
            setDeadline(data.deadline);
            setNote(data.note);
        }
    }, [data]);

    const submitForm = async () => {
        await axios
            .post("/home/project/add", {
                id,
                name,
                address,
                category,
                count,
                note,
                project_pict_path: picture
            })
            .then(response => {
                console.log(response);
                window.location = response.data.redirect;
            })
            .catch(e => {
                console.log(e);
            });
    };

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
                placeholder="Masukkan kategori"
                value={category}
                setValue={setCategory}
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
                title="Catatan"
                placeholder="Masukkan catatan"
                name="note"
                type="text"
                isRequired={true}
                value={note}
                setValue={setNote}
                disabled={isDisabled}
            />
            <Dropzone
                title="Upload Gambar Proyek"
                name="project_pict_path"
                value={picture}
                setValue={setPicture}
            />
            <HStack width="100%" my={2} justifyContent="flex-end">
                <Button onClick={onClose}>Cancel</Button>
                <Button colorScheme="teal" onClick={submitForm}>
                    Submit
                </Button>
            </HStack>
        </VStack>
    );
};

export default ProjectForm;
