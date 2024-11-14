<?php

namespace App\Core\User\Domain\Repository;

use App\Core\User\Domain\Exception\UserNotFoundException;
use App\Core\User\Domain\User;
use App\Core\User\Domain\Status\UserStatus;

interface UserRepositoryInterface
{
    /**
     * @return array<int, mixed>
     */
    public function getUsersByStatus(UserStatus $userStatus): array;

    /**
     * @throws UserNotFoundException
     */
    public function getByEmail(string $email): User;
    public function save(User $user): void;

    public function flush(): void;
}
