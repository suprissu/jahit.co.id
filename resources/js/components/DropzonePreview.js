import React from "react";
import { Image, IconButton, Box, HStack } from "@chakra-ui/react";
import { CloseIcon } from "@chakra-ui/icons";

const DropzonePreview = ({ paths, deleteClick }) => {
    return (
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
                          {deleteClick ? (
                              <IconButton
                                  position="absolute"
                                  top="50%"
                                  left="50%"
                                  transform="translate(-50%, -50%)"
                                  colorScheme="red"
                                  aria-label="remove picture"
                                  onClick={deleteClick}
                                  icon={<CloseIcon />}
                              />
                          ) : null}
                      </Box>
                  ))
                : null}
        </HStack>
    );
};

export default DropzonePreview;
