<?php

namespace App\UI\Cli\Command\User;

use App\Application\Query\QueryBus;
use App\Application\Query\User\FindByEmail\FindByEmailQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class FindByEmailCommand extends Command
{
    private ValidatorInterface $validator;
    private MessageBusInterface $queryBus;

    public function __construct(ValidatorInterface $validator, MessageBusInterface $queryBus)
    {
        parent::__construct();
        $this->validator = $validator;
        $this->queryBus  = $queryBus;
    }

    protected function configure(): void
    {
        $this
            ->setName('app:user:find')
            ->setDescription('Give email for looking fo user.')
            ->addArgument('email', InputArgument::REQUIRED, 'User email');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = (string)$input->getArgument('email');

        $errors = $this->validator->validate($email, new Assert\Email());

        if ($errors->count()) {
            $errorMessage = $errors[0]->getMessage();
            $output->writeln("<error>$errorMessage</error>");

            return Command::FAILURE;
        }

        $envelope = $this->queryBus->dispatch(new FindByEmailQuery($email));

        $handled = $envelope->last(HandledStamp::class);
        dd("Result", $handled->getResult());

        $output->writeln('<info>User was find</info>');

        return Command::SUCCESS;
    }
}