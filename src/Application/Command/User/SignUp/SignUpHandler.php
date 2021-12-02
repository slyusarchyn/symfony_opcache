<?php

namespace App\Application\Command\User\SignUp;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\User;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class SignUpHandler implements MessageHandlerInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(SignUpCommand $command)
    {
        $user = User::create(
            $command->uuid,
            $command->email,
            password_hash($command->plainPassword, PASSWORD_BCRYPT)
        );

        $this->userRepository->store($user);
    }
}