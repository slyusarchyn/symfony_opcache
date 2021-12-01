<?php

namespace App\UI\Cli\Command\User;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class CreateUserCommand extends Command
{
    private ValidatorInterface $validator;

    public function __construct(string $name = null, ValidatorInterface $validator)
    {
        parent::__construct($name);
        $this->validator = $validator;
    }

    protected function configure(): void
    {
        $this
            ->setName('app:user:create')
            ->setDescription('Give email and password to create new user.')
            ->addArgument('email', InputArgument::REQUIRED, 'User email')
            ->addArgument('password', InputArgument::REQUIRED, 'User password')
            ->addArgument('uuid', InputArgument::OPTIONAL, 'User Uuid');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $uuid     = ($input->getArgument('uuid') ?: Uuid::uuid4());
        $email    = (string)$input->getArgument('email');
        $password = (string)$input->getArgument('password');

        $emailConstraint = new Assert\Email();

        $errors = $this->validator->validate($email, $emailConstraint);

        if ($errors->count()) {
            $errorMessage = $errors[0]->getMessage();
            $output->writeln("<error>$errorMessage</error>");

            return Command::FAILURE;
        }

        $output->writeln('<info>User Created: </info>');
        $output->writeln(sprintf('Uuid: %s', $uuid));
        $output->writeln(sprintf('Email: %s', $email));
        $output->writeln(sprintf('Password: %s', $password));

        return Command::SUCCESS;
    }
}