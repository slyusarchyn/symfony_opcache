<?php

namespace App\Application\Query\User\FindByEmail;

use Symfony\Component\Messenger\HandleTrait;

final class FindByEmailQuery
{
    use HandleTrait;

    public string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}