<?php

namespace App\UI\Http\Rest\External\Controller\Auth;

use App\UI\Http\Rest\External\Request\Auth\SignInRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class SignInController extends AbstractController
{
    public function __invoke(SignInRequest $request): JsonResponse
    {
        $email    = $request->get('email');
        $password = $request->get('password');

        return $this->json([
            'token' => "Token: $email-$password",
        ]);
    }
}