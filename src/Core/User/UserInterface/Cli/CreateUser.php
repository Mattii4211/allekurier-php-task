<?php

declare(strict_types=1);

namespace App\Core\User\UserInterface\Cli;

use App\Core\User\Application\Command\CreateUser\CreateUserCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:user:create',
    description: 'Dodawanie nowego użytkownika'
)]
class CreateUser extends Command
{
    public function __construct(private readonly MessageBusInterface $bus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getArgument('email');

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->bus->dispatch(new CreateUserCommand(
                $email
            ));
    
            return Command::SUCCESS;
        } else {
            $output->writeln('Incorrect email!');

            return Command::FAILURE;
        }
       
    }

    protected function configure(): void
    {
        $this->addArgument('email', InputArgument::REQUIRED);
    }
}
