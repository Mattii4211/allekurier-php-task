<?php

declare(strict_types=1);

namespace App\Core\User\Application\Query\GetUsersByStatus;

use App\Core\User\Domain\Status\UserStatus;

class GetUsersByStatusQuery
{
    public function __construct(public readonly UserStatus $status)
    {
    }
}
