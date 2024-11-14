<?php

declare(strict_types=1);

namespace App\Core\User\Application\Query\GetUsersByStatus;

use App\Core\User\Application\DTO\UserDTO;
use App\Core\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetUsersByStatusHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function __invoke(GetUsersByStatusQuery $query): array
    {
        $users = $this->userRepository->getUsersByStatus(
            $query->status
        );

        $output = [];

        foreach ($users as $user) {
            $output[] = new UserDTO(
                $user['id'],
                $user['email'],
                boolval($user['isActive'])
            );
        }

        return $output;
    }
}
