import React from "react";
import { Box, Tag, Text } from "@chakra-ui/react";
import { dateFormat } from "@utils/helper";
import {
    PROJECT_ON_NEGO,
    SAMPLE_REQUEST,
    SAMPLE_PAID_OK,
    SAMPLE_PAID_FAIL,
    SAMPLE_WORK_IN_PROGRESS,
    SAMPLE_FINISHED,
    SAMPLE_SENT,
    SAMPLE_RECEIVED,
    SAMPLE_APPROVED,
    SAMPLE_REJECTED,
    PROJECT_CANCELED,
    PROJECT_DP_OK,
    PROJECT_DP_FAIL,
    PROJECT_MOU_REQUEST,
    PROJECT_MOU_SIGNED,
    PROJECT_MOU_SIGNED_OK,
    PROJECT_MOU_SIGNED_FAIL,
    PROJECT_WORK_IN_PROGRESS,
    PROJECT_LATE,
    PROJECT_FAILED,
    PROJECT_REFUND_REQUEST,
    PROJECT_REFUND_SENT,
    PROJECT_FINISHED,
    PROJECT_FULL_PAYMENT_OK,
    PROJECT_FULL_PAYMENT_FAIL,
    PROJECT_SENT,
    PROJECT_RECEIVED,
    PROJECT_DONE,
    PAY_WAIT,
    PAY_OK,
    PAY_FAIL
} from "@utils/Constants";

const CustomTag = ({ status, deadline }) => {
    const STATUS_SUCCESS = [
        PROJECT_DP_OK,
        PROJECT_FINISHED,
        PROJECT_FULL_PAYMENT_OK,
        PROJECT_SENT,
        PROJECT_DONE,
        SAMPLE_PAID_OK,
        PROJECT_RECEIVED,
        SAMPLE_RECEIVED,
        SAMPLE_SENT,
        SAMPLE_FINISHED,
        SAMPLE_APPROVED,
        PROJECT_MOU_SIGNED,
        PROJECT_MOU_SIGNED_OK,
        PROJECT_REFUND_SENT,
        PAY_OK
    ];
    const STATUS_FAILED = [
        PROJECT_FAILED,
        SAMPLE_PAID_FAIL,
        PROJECT_CANCELED,
        SAMPLE_REJECTED,
        PROJECT_DP_FAIL,
        PROJECT_MOU_SIGNED_FAIL,
        PROJECT_LATE,
        PROJECT_FULL_PAYMENT_FAIL,
        PAY_FAIL
    ];
    const STATUS_IN_PROGRESS = [
        PROJECT_ON_NEGO,
        SAMPLE_WORK_IN_PROGRESS,
        PROJECT_WORK_IN_PROGRESS,
        PROJECT_REFUND_REQUEST,
        PROJECT_MOU_REQUEST,
        SAMPLE_REQUEST,
        PAY_WAIT
    ];

    if (STATUS_SUCCESS.includes(status)) {
        return (
            <Tag size="md" colorScheme="teal">
                {status}
            </Tag>
        );
    } else if (STATUS_IN_PROGRESS.includes(status)) {
        return (
            <Box display="flex" flexDirection="column" alignItems="center">
                <Tag size="md" colorScheme="yellow">
                    {status}
                </Tag>
                {deadline && deadline !== "" ? (
                    <Text fontSize="xs">Deadline: {dateFormat(deadline)}</Text>
                ) : null}
            </Box>
        );
    } else if (STATUS_FAILED.includes(status)) {
        return (
            <Tag size="md" colorScheme="red">
                {status}
            </Tag>
        );
    } else {
        return <Tag size="md">{status}</Tag>;
    }
};

export default CustomTag;
