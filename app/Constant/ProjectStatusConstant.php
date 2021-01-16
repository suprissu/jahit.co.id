<?php

namespace App\Constant;

class ProjectStatusConstant
{
    public const PROJECT_OPENED             = 'Penawaran Terbuka';
    public const PROJECT_ON_NEGO            = 'Negosiasi Berlangsung';
    public const SAMPLE_REQUEST             = 'Menunggu Pembayaran Sampel';
    public const SAMPLE_PAID_OK             = 'Pembayaran Sampel Valid';
    public const SAMPLE_PAID_FAIL           = 'Pembayaran Sampel Invalid';
    public const SAMPLE_WORK_IN_PROGRESS    = 'Sampel Dikerjakan';
    public const SAMPLE_FINISHED            = 'Sampel Selesai';
    public const SAMPLE_SENT                = 'Sampel Dikirim';
    public const SAMPLE_RECEIVED            = 'Sampel Diterima';
    public const PROJECT_DEALT              = 'Menunggu Pembayaran DP';
    public const PROJECT_CANCELED           = 'Dibatalkan';
    public const PROJECT_DP_OK              = 'Pembayaran DP Valid';
    public const PROJECT_DP_FAIL            = 'Pembayaran DP Invalid';
    public const PROJECT_MOU_REQUEST        = 'Menunggu Tanda Tangan MOU';
    public const PROJECT_MOU_SIGNED         = 'MOU Ditandatangani';
    public const PROJECT_MOU_SIGNED_OK      = 'MOU Valid';
    public const PROJECT_MOU_SIGNED_FAIL    = 'MOU Invalid';
    public const PROJECT_WORK_IN_PROGRESS   = 'Dalam Pengerjaan';
    public const PROJECT_LATE               = 'Terlambat';
    public const PROJECT_FAILED             = 'Gagal Diselesaikan';
    public const PROJECT_REFUND_REQUEST     = 'Meminta Pengembalian Uang';
    public const PROJECT_REFUND_SENT        = 'Pengembalian Uang Telah Dikirim';
    public const PROJECT_FINISHED           = 'Selesai & Menunggu Pelunasan';
    public const PROJECT_FULL_PAYMENT_OK    = 'Pembayaran Lunas Valid';
    public const PROJECT_FULL_PAYMENT_FAIL  = 'Pembayaran Lunas Invalid';
    public const PROJECT_SENT               = 'Telah Dikirim';
    public const PROJECT_RECEIVED           = 'Telah Diterima';
    public const PROJECT_DONE               = 'Vendor Telah Dibayar';
}