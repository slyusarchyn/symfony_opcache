<?php

namespace App\Application\Query\User\FindByEmail;

use App\Application\Query\QueryHandlerInterface;

final class FindByEmailHandler implements QueryHandlerInterface
{
    public function __invoke(FindByEmailQuery $query): string
    {
        return $query->email;
    }
}