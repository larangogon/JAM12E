<?php

namespace App\Constants;

use MyCLabs\Enum\Enum;

class Statuses extends Enum
{
    public const APPROVED           = 'APPROVED';
    public const REJECTED           = 'REJECTED';
    public const PENDING            = 'PENDING';
    public const PENDING_PAY        = 'PENDING_PAY';
    public const APROVADO_EN_TIENDA = 'APROVADO_EN_TIENDA';
}
