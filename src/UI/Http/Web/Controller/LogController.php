<?php

namespace App\UI\Http\Web\Controller;

use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class LogController extends AbstractController
{
    public function __invoke(LoggerInterface $logger): JsonResponse
    {
        $logger->info('Random info string ' . Uuid::uuid4()->toString());
        $logger->error('Random error string ' . Uuid::uuid4()->toString());
        $logger->critical('Random critical string ' . Uuid::uuid4()->toString());
        $logger->alert('Random alert string ' . Uuid::uuid4()->toString());

        return $this->json([
            'log' => 'ok',
        ]);
    }
}