<?php

namespace App\Application\Command\User\SignUp;

use Ramsey\Uuid\UuidInterface;

final class SignUpCommand
{
    public UuidInterface $uuid;
    public string $email;
    public string $plainPassword;

    public function __construct(UuidInterface $uuid, string $email, string $plainPassword)
    {
        $this->uuid          = $uuid;
        $this->email         = $email;
        $this->plainPassword = $plainPassword;
    }
}