<?php

namespace App\UI\Http\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class IndexController extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'page' => 'index',
        ]);
    }
}