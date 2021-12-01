<?php

namespace App\UI\Http\Rest\External\Request\Auth;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

final class SignInRequest extends Request
{
    public function rules(): Assert\Collection
    {
        return new Assert\Collection([
            'email'    => new Assert\Required(['message' => '\'email\' field is required']),
            'password' => new Assert\Required(['message' => '\'password\' field required']),
        ]);
    }
}