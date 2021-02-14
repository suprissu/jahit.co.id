import React from "react";
import { Box, Tag, Text } from "@chakra-ui/react";
import { dateFormat } from "../../utils/helper";

const CustomTag = ({ data }) => {
    const status = data.status;
    const deadline = data.deadline || "";
    const success = [
        "Pembayaran DP Valid",
        "Pembayaran Sampel Valid",
        "Sampel Diterima",
        "Telah Dikirim",
        "Telah Diterima",
        "Vendor Telah Dibayar",
        "MOU Ditandatangani",
        "MOU Valid",
        "Pengembalian Uang Telah Dikirim",
        "Pembayaran Lunas Valid"
    ];
    const failed = [
        "Pembayaran Sampel Invalid",
        "Dibatalkan",
        "Pembayaran DP Invalid",
        "MOU Invalid",
        "Terlambat",
        "Gagal Diselesaikan",
        "Pembayaran Lunas Invalid"
    ];
    const progress = [
        "Negosiasi Berlangsung",
        "Sampel Dikerjakan",
        "Sampel Selesai",
        "Sampel Dikirim",
        "Dalam Pengerjaan",
        "Selesai & Menunggu Pelunasan",
        "Meminta Pengembalian Uang"
    ];

    if (success.includes(status)) {
        return (
            <Tag size="md" colorScheme="teal">
                {status}
            </Tag>
        );
    } else if (progress.includes(status)) {
        return (
            <Box display="flex" flexDirection="column" alignItems="center">
                <Tag size="md" colorScheme="yellow">
                    {status}
                </Tag>
                <Text fontSize="xs">
                    Deadline:
                    {dateFormat(deadline)}
                </Text>
            </Box>
        );
    } else if (failed.includes(status)) {
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
