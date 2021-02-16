import React, { useContext, useEffect, useState } from "react";
import { HStack, VStack, Image } from "@chakra-ui/react";

const PreviewImage = ({ images }) => {
    const [selectedImage, setSelectedImage] = useState("");

    if (images && images.length === 0) return null;

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

export default PreviewImage;
