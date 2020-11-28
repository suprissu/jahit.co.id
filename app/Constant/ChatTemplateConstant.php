<?php

namespace App\Constant;

class ChatTemplateConstant
{
    public const CUSTOMER_ROLE              = 'CLIENT';
    public const PARTNER_ROLE               = 'VENDOR';

    public const INITIATION_TYPE            = 'INISIASI';
    public const NEGOTIATION_TYPE           = 'NEGOSIASI';
    public const PROJECT_ACCEPT_TYPE        = 'SETUJU';
    public const PROJECT_OFFER_TYPE         = 'DIAJUKAN';
    public const VERIFICATION_TYPE          = 'VERIFIKASI';
    public const SAMPLE_SENT_TYPE           = 'SAMPLE TERKIRIM';
    public const PROJECT_DEAL_TYPE          = 'DEAL';
    public const REVISION_REJECTED_TYPE     = 'REVISI DITOLAK';

    public const BLANK_ANSWER               = "";
    public const ACCEPT_ANSWER              = "accept";
    public const REJECT_ANSWER              = "reject";
    public const SAMPLE_ANSWER              = "sample";
    public const DEAL_ANSWER                = "deal";
}