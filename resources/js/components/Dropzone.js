import React, { useEffect, useState } from "react";
import DropzoneComponent from "react-dropzone-component";
import "../../sass/dropzone.scss";
import {
    FormControl,
    FormLabel,
    InputGroup,
    VStack,
    FormErrorMessage,
    FormHelperText,
    Wrap,
    WrapItem,
    Image,
    IconButton,
    HStack,
    Box
} from "@chakra-ui/react";
import { CloseIcon } from "@chakra-ui/icons";

const djsConfig = {
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif",
    autoProcessQueue: false
};

const config = {
    iconFiletypes: [".jpg", ".png", ".gif"],
    showFiletypeIcon: true,
    postUrl: "no-url"
};

const Dropzone = ({ name, title, error, helper, value, setValue }) => {
    const [paths, setPaths] = useState([]);

    useEffect(() => {
        fetchPaths();
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
        setValue(state => {
            return [...state, file];
        });
    };

    const removedfile = index => {
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
                <HStack
                    width="100%"
                    justifyContent="flex-start"
                    alignItems="flex-start"
                    flexWrap="wrap"
                >
                    {paths
                        ? paths.map((data, index) => (
                              <Box
                                  position="relative"
                                  width="94px"
                                  height="94px"
                                  key={index}
                              >
                                  <Image
                                      boxSize="94px"
                                      objectFit="cover"
                                      borderRadius="5px"
                                      src={data}
                                      fallbackSrc="https://via.placeholder.com/54"
                                      alt="preview"
                                      position="absolute"
                                      top="50%"
                                      left="50%"
                                      transform="translate(-50%, -50%)"
                                  />
                                  <IconButton
                                      position="absolute"
                                      top="50%"
                                      left="50%"
                                      transform="translate(-50%, -50%)"
                                      colorScheme="red"
                                      aria-label="remove picture"
                                      onClick={() => removedfile(index)}
                                      icon={<CloseIcon />}
                                  />
                              </Box>
                          ))
                        : null}
                </HStack>
                <DropzoneComponent
                    name={name}
                    config={config}
                    eventHandlers={eventHandlers}
                    djsConfig={djsConfig}
                />
            </VStack>
            <FormErrorMessage>{error}</FormErrorMessage>
            <FormHelperText>{helper}</FormHelperText>
        </FormControl>
    );
};

export default Dropzone;
