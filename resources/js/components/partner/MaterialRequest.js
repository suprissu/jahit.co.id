import React, { useState } from "react";
import {
    VStack,
    FormControl,
    FormLabel,
    HStack,
    Button,
    Spinner
} from "@chakra-ui/react";
import axios from "axios";
import NormalInput from "@components/NormalInput";
import SelectInput from "@components/SelectInput";
import AlertDialog from "@components/dialog/AlertDialog";
import { useProps } from "@utils/Context";
import { URL_REQUEST_MATERIAL } from "@utils/Path";

const MaterialRequest = ({ onClose }) => {
    const { partner, materials } = useProps();
    const [projectID, setProjectID] = useState("");
    const [materialID, setMaterialID] = useState("");
    const [additionalInfo, setAdditionalInfo] = useState("");
    const [quantity, setQuantity] = useState("");
    const [note, setNote] = useState("");
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(false);

    const projectOptions = partner.projects.map(data => {
        return {
            key: data.id,
            value: data.id,
            text: data.name
        };
    });

    const materialOptions = materials.map(data => {
        return {
            key: data.id,
            value: data.id,
            text: data.name
        };
    });

    const submitForm = async () => {
        setLoading(true);
        await axios
            .post(URL_REQUEST_MATERIAL, {
                projectID,
                materialID,
                additionalInfo,
                quantity,
                note
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

    const isDisabled =
        projectID === "" ||
        materialID === "" ||
        (materialID === 36 && additionalInfo === "") ||
        quantity === "";

    return (
        <VStack>
            <AlertDialog
                content={error}
                isOpen={error}
                onClose={() => setError(null)}
            />
            <SelectInput
                name="proyekID"
                title="Nama Proyek"
                placeholder="Pilih nama proyek yang sedang anda kerjakan"
                value={projectID}
                setValue={setProjectID}
                options={projectOptions}
            />
            <SelectInput
                name="materialID"
                title="Nama Bahan"
                placeholder="Pilih bahan yang diperlukan"
                value={materialID}
                setValue={setMaterialID}
                options={materialOptions}
            />
            {materialID === 36 ? (
                <NormalInput
                    title="Nama Bahan Khusus"
                    placeholder="Masukkan satu bahan khusus yang anda perlu"
                    name="additionalInfo"
                    type="text"
                    isRequired={true}
                    value={additionalInfo}
                    setValue={setAdditionalInfo}
                />
            ) : null}
            <NormalInput
                title="Jumlah Bahan"
                placeholder="Masukkan jumlah bahan"
                name="quantity"
                type="number"
                isRequired={true}
                value={quantity}
                setValue={setQuantity}
            />
            <NormalInput
                title="Catatan"
                placeholder="Masukkan catatan"
                name="note"
                type="text"
                isRequired={true}
                value={note}
                setValue={setNote}
            />
            <HStack width="100%" my={2} justifyContent="flex-end">
                <Button onClick={onClose}>Cancel</Button>
                <Button
                    colorScheme="teal"
                    onClick={submitForm}
                    disabled={isDisabled || loading}
                >
                    {loading ? <Spinner /> : "Submit"}
                </Button>
            </HStack>
        </VStack>
    );
};

export default MaterialRequest;
