import React, { useEffect, useState } from "react";
import { VStack, HStack, Button, Spinner } from "@chakra-ui/react";
import axios from "axios";
import Dropzone from "@components/Dropzone";
import NormalInput from "@components/NormalInput";
import SelectInput from "@components/SelectInput";
import AlertDialog from "@components/dialog/AlertDialog";
import { useProps } from "@utils/Context";

const ProjectForm = ({ data, onClose }) => {
    const { categories } = useProps();
    const [id, setId] = useState(null);
    const [name, setName] = useState("");
    const [address, setAddress] = useState("");
    const [category, setCategory] = useState("");
    const [count, setCount] = useState("");
    const [note, setNote] = useState("");
    const [picture, setPicture] = useState([]);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(false);

    const categoryOptions = categories.map(data => {
        return {
            key: data.id,
            value: data.id,
            text: data.name
        };
    });

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
        setLoading(true);
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
            })
            .finally(() => {
                setLoading(false);
            });
    };

    const isDisabled = data !== undefined && data !== null;

    return (
        <VStack>
            <AlertDialog
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
            <SelectInput
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
                multiple={true}
                previewOnly={data !== undefined && data !== null}
            />
            <HStack width="100%" my={2} justifyContent="flex-end">
                <Button onClick={onClose}>Cancel</Button>
                <Button
                    colorScheme="teal"
                    onClick={submitForm}
                    disabled={(data !== undefined && data !== null) || loading}
                >
                    {loading ? <Spinner /> : "Submit"}
                </Button>
            </HStack>
        </VStack>
    );
};

export default ProjectForm;
