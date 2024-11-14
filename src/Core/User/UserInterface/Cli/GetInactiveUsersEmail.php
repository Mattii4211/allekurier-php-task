<?php

declare(strict_types=1);

namespace App\Core\User\UserInterface\Cli;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Common\Bus\QueryBusInterface;
use App\Core\User\Application\DTO\UserDTO;
use App\Core\User\Application\Query\GetUsersByStatus\GetUsersByStatusQuery;
use App\Core\User\Domain\Status\UserStatus;

#[AsCommand(
    name: 'app:user:get-inactive-emails',
    description: 'Lista nieaktywnych użytkowników'
)]
class GetInactiveUsersEmail extends Command
{
    public function __construct(private readonly QueryBusInterface $bus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $users = $this->bus->dispatch(
            new GetUsersByStatusQuery(
                UserStatus::INACTIVE
            )
        );

        /** @var  array<int, UserDTO> $users */
         foreach ($users as $key => $user) {
            $output->writeln("$key. $user->email");
        }

        return Command::SUCCESS;
    }
}
