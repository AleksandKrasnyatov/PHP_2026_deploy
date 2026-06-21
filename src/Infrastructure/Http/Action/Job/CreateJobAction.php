<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Action\Job;

use App\Infrastructure\Http\Support\JsonResponse;
use JsonException;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class CreateJobAction
{
    #[OA\Post(
        path: '/job',
        operationId: 'createJob',
        description: 'Ставит новую задачу обработки в очередь',
        summary: 'Создать задачу',
        tags: ['Job'],
        responses: [
            new OA\Response(
                response: 201,
                description: 'Задача создана'
            ),
            new OA\Response(
                response: 422,
                description: 'Ошибка валидации'
            ),
        ]
    )]
    /**
     * @throws JsonException
     */
    public function __invoke(Request $request, Response $response): Response
    {
        return JsonResponse::write(
            $response->withStatus(201),
            ['taskId' => rand()]
        );
    }
}
