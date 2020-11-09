<?php

namespace App\Constants;

use MyCLabs\Enum\Enum;

class Statuses extends Enum
{
    public const APPROVED    = 'APPROVED';
    public const REJECTED    = 'REJECTED';
    public const PENDING     = 'PENDING';
    public const pending_pay = 'pending_pay';
}
