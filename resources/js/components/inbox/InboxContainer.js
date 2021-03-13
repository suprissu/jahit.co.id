import React from "react";
import { Heading, VStack, Image } from "@chakra-ui/react";
import Messages from "@components/inbox/Messages";
import { useData, useProps } from "@utils/Context";

const InboxContainer = () => {
    const { isMobile } = useProps();
    const { selectedData } = useData();

    return (
        <VStack
            width={isMobile && selectedData ? "100%" : "auto"}
            height="100%"
            flex="1"
            borderWidth="1px"
            justifyContent="center"
            alignItems="center"
        >
            {selectedData ? (
                <Messages data={selectedData} />
            ) : (
                <VStack>
                    <Image
                        boxSize="240px"
                        objectFit="contain"
                        borderRadius="5px"
                        src="/img/empty-chat.svg"
                        alt="preview"
                        loading="lazy"
                    />
                    <Heading as="h4" size="md">
                        Mulai transaksi untuk chat.
                    </Heading>
                </VStack>
            )}
        </VStack>
    );
};

export default InboxContainer;
