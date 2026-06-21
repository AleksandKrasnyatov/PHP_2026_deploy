<?php

declare(strict_types=1);

use App\Infrastructure\RabbitMq\Amqp\Connection;
use Slim\Views\Twig;

return [
    Twig::class => static fn (): Twig => Twig::create('/app/src/Infrastructure/Http/Template', ['cache' => false]),

    Connection::class => static function (): Connection {
        static $connection = null;

        if ($connection === null) {
            $connection = new Connection(
                host: getenv('RABBITMQ_HOST') ?: 'rabbitmq',
                port: (int) (getenv('RABBITMQ_PORT') ?: 5672),
                user: getenv('RABBITMQ_USER') ?: 'guest',
                password: getenv('RABBITMQ_PASSWORD') ?: 'guest',
                vhost: getenv('RABBITMQ_VHOST') ?: '/',
            );
        }

        return $connection;
    },
];
