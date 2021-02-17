import React, { useContext, useEffect, useState } from "react";
import { HStack, VStack, Image } from "@chakra-ui/react";

const PreviewImage = ({ images }) => {
    const [selectedImage, setSelectedImage] = useState("");

    if (images && images.length === 0) return null;

    useEffect(() => {
        setSelectedImage(images[0].path);
    }, []);

    return (
        <VStack width="100%" justifyContent="center">
            <Image
                width="100%"
                height="280px"
                objectFit="contain"
                borderRadius="5px"
                src={selectedImage}
                fallbackSrc="https://via.placeholder.com/54"
                alt="preview"
            />
            <HStack
                width="100%"
                overflowX="auto"
                justifyContent="flex-start"
                alignItems="flex-start"
            >
                {images.map((data, index) => (
                    <Image
                        minWidth="92px"
                        maxWidth="92px"
                        minHeight="92px"
                        maxHeight="92px"
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
            </HStack>
        </VStack>
    );
};

export default PreviewImage;
