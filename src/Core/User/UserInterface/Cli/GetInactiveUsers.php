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
    name: 'app:user:get-inactive',
    description: 'Lista nieaktywnych użytkowników'
)]
class GetInactiveUsers extends Command
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

        /** @var UserDTO $users */
         foreach ($users as $user) {
            $output->writeln("$user->id. $user->email");
        }

        return Command::SUCCESS;
    }
}
