<?php

namespace App\Constants;

use MyCLabs\Enum\Enum;

class Statuses extends Enum
{
    public const PAID = 'APPROVED';
    public const UNPAID = 'REJECTED';
    public const OVERDUE = 'PENDING';
}
