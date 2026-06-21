<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Support;

use JsonException;
use Psr\Http\Message\ResponseInterface;

final class JsonResponse
{
    /**
     * @param array<string, mixed> $payload
     * @throws JsonException
     */
    public static function write(ResponseInterface $response, array $payload): ResponseInterface
    {
        $response->getBody()->write((string) json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
