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

    /**
     * @return array<int, UserDTO>
     */
    public function __invoke(GetUsersByStatusQuery $query): array
    {
        $users = $this->userRepository->getUsersByStatus(
            $query->status
        );

        $output = [];

        foreach ($users as $row) {
            $output[] = new UserDTO(
                $row['id'],
                $row['email'],
                boolval($row['isActive'])
            );
        }

        return $output;
    }
}
