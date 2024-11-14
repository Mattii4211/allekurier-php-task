<?php

declare(strict_types=1);

namespace App\Core\User\Domain\Status;

enum UserStatus: int
{
    case ACTIVE = 1;
    case INACTIVE = 0;
}
