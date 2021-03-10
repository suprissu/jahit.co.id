import React from "react";
import { Image, IconButton, Box, HStack } from "@chakra-ui/react";
import { CloseIcon } from "@chakra-ui/icons";

const DropzonePreview = ({ paths, deleteClick, multiple, fluid }) => {
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
                          width={multiple ? "94px" : "100%"}
                          height={fluid ? "auto" : "94px"}
                          key={index}
                      >
                          <Image
                              width={multiple ? "94px" : "100%"}
                              height={fluid ? "auto" : "94px"}
                              objectFit="cover"
                              borderRadius="5px"
                              src={data}
                              fallbackSrc="https://via.placeholder.com/54"
                              alt="preview"
                              position={fluid ? "static" : "absolute"}
                              top={fluid ? "" : "50%"}
                              left={fluid ? "" : "50%"}
                              transform={fluid ? "" : "translate(-50%, -50%)"}
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
