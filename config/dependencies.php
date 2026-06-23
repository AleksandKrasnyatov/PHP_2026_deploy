<?php

declare(strict_types=1);

use App\Application\Gateway\MessageBroker\Message\MessageDispatcher;
use App\Application\Gateway\MessageBroker\Message\ProcessTaskMessageHandler;
use App\Application\UseCase\Task\Command\ProcessTaskHandler;
use App\Infrastructure\MessageBroker\Amqp\Connection;
use Psr\Container\ContainerInterface;
use Slim\Views\Twig;

use function DI\add;
use function DI\get;

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
    'message_handlers' => add([
        get(ProcessTaskMessageHandler::class),
    ]),
    MessageDispatcher::class => static function (ContainerInterface $c): MessageDispatcher {
        return new MessageDispatcher($c->get('message_handlers'));
    },
];
