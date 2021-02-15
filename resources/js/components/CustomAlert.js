import React from "react";
import {
    AlertDialog,
    AlertDialogOverlay,
    AlertDialogBody,
    AlertDialogContent,
    AlertDialogHeader,
    AlertDialogCloseButton
} from "@chakra-ui/react";

const CustomAlert = ({ title, content, isOpen, onClose }) => {
    const cancelRef = React.useRef();

    return (
        <AlertDialog
            motionPreset="slideInBottom"
            leastDestructiveRef={cancelRef}
            onClose={onClose}
            isOpen={isOpen}
        >
            <AlertDialogOverlay />

            <AlertDialogContent>
                <AlertDialogHeader>{title}</AlertDialogHeader>
                <AlertDialogCloseButton />
                <AlertDialogBody>{content}</AlertDialogBody>
            </AlertDialogContent>
        </AlertDialog>
    );
};

export default CustomAlert;
