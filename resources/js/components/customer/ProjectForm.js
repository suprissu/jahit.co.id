import React, { useEffect, useState } from "react";
import {
    VStack,
    FormControl,
    FormLabel,
    HStack,
    Button
} from "@chakra-ui/react";
import NormalInput from "../NormalInput";
import { Dropdown, Form } from "semantic-ui-react";
import Dropzone from "../Dropzone";
import { useProps } from "../../utils/CustomerContext";
import axios from "axios";
import CustomAlert from "../CustomAlert";

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
    const [error, setError] = useState(null);

    useEffect(() => {
        if (data !== null) {
            setId(data.id);
            setName(data.name);
            setCategory(data.category_id);
            setCount(data.count);
            setNote(data.note);
            setAddress(data.address);
            const paths = data.images.map(img => img.path);
            setPicture(paths);
        }
    }, [data]);

    const submitForm = async () => {
        const formData = new FormData();
        if (data !== null) formData.append("id", id);
        formData.append("name", name);
        formData.append("address", address);
        formData.append("category", category);
        formData.append("count", count);
        formData.append("note", note);
        picture.forEach(data => {
            formData.append("project_pict_path[]", data);
        });
        await axios
            .post("/home/project/add", formData, {
                headers: { "Content-Type": "multipart/form-data" }
            })
            .then(response => {
                window.location = response.request.responseURL;
            })
            .catch(e => {
                setError(e);
            });
    };

    const isDisabled = data !== undefined && data !== null;

    return (
        <VStack>
            <CustomAlert
                content={error}
                isOpen={error}
                onClose={() => setError(null)}
            />
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
                disabled={isDisabled}
                previewOnly={data !== undefined && data !== null}
            />
            <HStack width="100%" my={2} justifyContent="flex-end">
                <Button onClick={onClose}>Cancel</Button>
                <Button
                    colorScheme="teal"
                    onClick={submitForm}
                    disabled={data !== undefined && data !== null}
                >
                    Submit
                </Button>
            </HStack>
        </VStack>
    );
};

export default ProjectForm;
