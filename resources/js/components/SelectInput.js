import React from "react";
import { FormControl, FormLabel } from "@chakra-ui/react";
import { Dropdown } from "semantic-ui-react";

const SelectInput = ({
    placeholder,
    disabled,
    name,
    value,
    setValue,
    error,
    title,
    options
}) => {
    return (
        <FormControl
            id={name}
            pt={2}
            isInvalid={
                error !== undefined && error !== null && error.length > 0
            }
        >
            <FormLabel>{title}</FormLabel>
            <Dropdown
                placeholder={placeholder}
                fluid
                search
                selection
                name={name}
                value={value}
                onChange={(e, { value }) => {
                    setValue(value);
                }}
                disabled={disabled}
                options={options}
            />
        </FormControl>
    );
};

export default SelectInput;
