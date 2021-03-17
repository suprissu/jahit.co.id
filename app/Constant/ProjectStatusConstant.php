<?php

namespace App\Constant;

class ProjectStatusConstant
{
    public const PROJECT_OPENED             = 'Penawaran Terbuka';
    public const SAMPLE_REQUEST             = 'Pembayaran Sampel';
    public const SAMPLE_WORK_IN_PROGRESS    = 'Sampel Dikerjakan';
    public const SAMPLE_FINISHED            = 'Sampel Selesai';
    public const SAMPLE_SENT                = 'Sampel Dikirim';
    public const PROJECT_DEALT              = 'Pembayaran DP';
    public const PROJECT_CANCELED           = 'Dibatalkan';
    public const PROJECT_DP_OK              = 'Pembayaran DP Valid';
    public const PROJECT_WORK_IN_PROGRESS   = 'Dalam Pengerjaan';
    public const PROJECT_FAILED             = 'Gagal Diselesaikan';
    public const PROJECT_REFUND_REQUEST     = 'Meminta Pengembalian Uang';
    public const PROJECT_REFUND_SENT        = 'Pengembalian Uang Telah Dikirim';
    public const PROJECT_FINISHED           = 'Pembayaran Pelunasan';
    public const PROJECT_FULL_PAYMENT_OK    = 'Pembayaran Lunas OK';
    public const PROJECT_FULL_PAYMENT_FAIL  = 'Pembayaran Lunas Gagal';
    public const PROJECT_SENT               = 'Telah Dikirim';
    public const PROJECT_DONE               = 'Vendor Telah Dibayar';
}