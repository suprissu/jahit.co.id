import React from "react";
import {
    FormControl,
    FormLabel,
    FormErrorMessage,
    FormHelperText,
    InputGroup,
    Input,
    NumberInput,
    NumberInputField,
    NumberInputStepper,
    NumberIncrementStepper,
    NumberDecrementStepper
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
    disabled,
    min,
    max
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
                    <NumberInput
                        name={name}
                        pr="4.5rem"
                        value={value}
                        onChange={e => setValue(e)}
                        disabled={disabled}
                        paddingRight={disabled ? "0px" : ""}
                        min={1}
                        width="100%"
                    >
                        <NumberInputField
                            placeholder={"Masukkan " + title}
                            required={isRequired}
                        />
                        {!disabled ? (
                            <NumberInputStepper>
                                <NumberIncrementStepper />
                                <NumberDecrementStepper />
                            </NumberInputStepper>
                        ) : null}
                    </NumberInput>
                ) : (
                    <Input
                        name={name}
                        type={type}
                        value={value}
                        min={min}
                        max={max}
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
