import React, { useEffect, useState } from "react";
import DropzoneComponent from "react-dropzone-component";
import "@sass/dropzone.scss";
import {
    FormControl,
    FormLabel,
    VStack,
    FormErrorMessage,
    FormHelperText,
    HStack
} from "@chakra-ui/react";
import DropzonePreview from "./DropzonePreview";

const djsConfig = {
    addRemoveLinks: true,
    acceptedFiles: ".png, .jpg",
    autoProcessQueue: false
};

const config = {
    iconFiletypes: [".jpg", ".png", ".gif"],
    showFiletypeIcon: true,
    postUrl: "no-url"
};

const Dropzone = ({
    disabled,
    name,
    title,
    error,
    helper,
    value,
    setValue,
    multiple,
    previewOnly
}) => {
    const [paths, setPaths] = useState([]);

    useEffect(() => {
        if (!previewOnly) fetchPaths();
        else setPaths(value);
    }, [value]);

    const fetchPaths = () => {
        const result = value.map(async data => {
            const path = await readFile(data);
            return path;
        });
        Promise.all(result).then(data => {
            setPaths(data);
        });
    };

    const handleFileAdded = file => {
        if (multiple) {
            setValue(state => {
                return [...state, file];
            });
        } else {
            setValue([file]);
        }
    };

    const removedfile = index => {
        if (multiple) {
            setValue(state => {
                const res = [...state];
                res.splice(index, 1);
                return res;
            });
            setPaths(state => {
                const res = [...state];
                res.splice(index, 1);
                return res;
            });
        } else {
            setValue([]);
            setPaths([]);
        }
    };

    const eventHandlers = {
        addedfile: handleFileAdded,
        removedfile: removedfile
    };

    const reader = file => {
        return new Promise((resolve, reject) => {
            const fileReader = new FileReader();
            fileReader.onload = () => resolve(fileReader.result);
            fileReader.readAsDataURL(file);
        });
    };

    const readFile = async file => {
        const data = await reader(file);
        return data;
    };

    return (
        <FormControl
            id={name}
            pt={2}
            isInvalid={
                error !== undefined && error !== null && error.length > 0
            }
        >
            <FormLabel>{title}</FormLabel>
            <VStack>
                <DropzonePreview
                    paths={paths}
                    deleteClick={!previewOnly ? removedfile : null}
                    multiple={multiple}
                />
                {!previewOnly ? (
                    <DropzoneComponent
                        name={name}
                        config={config}
                        eventHandlers={eventHandlers}
                        djsConfig={djsConfig}
                        disabled={disabled}
                    />
                ) : null}
            </VStack>
            <FormErrorMessage>{error}</FormErrorMessage>
            <FormHelperText>{helper}</FormHelperText>
        </FormControl>
    );
};

export default Dropzone;
