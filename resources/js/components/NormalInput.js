import React from "react";
import {
    FormControl,
    FormLabel,
    FormErrorMessage,
    FormHelperText,
    InputGroup,
    Input
} from "@chakra-ui/react";

function NormalInput({
    title,
    type,
    helper,
    value,
    setValue,
    error,
    isRequired,
    name,
    disabled
}) {
    return (
        <FormControl
            id={name}
            pt={2}
            isInvalid={
                error !== undefined && error !== null && error.length > 0
            }
        >
            <FormLabel>{title}</FormLabel>
            <InputGroup size="md">
                {type === "number" ? (
                    <NumberInput max={50} min={10}>
                        <NumberInputField />
                        <NumberInputStepper>
                            <NumberIncrementStepper />
                            <NumberDecrementStepper />
                        </NumberInputStepper>
                    </NumberInput>
                ) : (
                    <Input
                        name={name}
                        pr="4.5rem"
                        type={type}
                        value={value}
                        onChange={e => setValue(e.target.value)}
                        placeholder={"Masukkan " + title}
                        isRequired={isRequired}
                        disabled={disabled}
                    />
                )}
            </InputGroup>
            <FormErrorMessage>{error}</FormErrorMessage>
            <FormHelperText>{helper}</FormHelperText>
        </FormControl>
    );
}

export default NormalInput;
