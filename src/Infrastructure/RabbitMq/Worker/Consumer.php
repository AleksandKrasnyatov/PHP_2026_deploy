<?php

declare(strict_types=1);

namespace App\Infrastructure\RabbitMq\Worker;

use App\Infrastructure\RabbitMq\Amqp\Connection;
use App\Infrastructure\RabbitMq\Amqp\Topology;
use PhpAmqpLib\Message\AMQPMessage;

final readonly class Consumer
{
    public function __construct(
        private Connection $connection,
        private Topology $topology,
    ) {
    }

    public function consume(): void
    {
        $channel = $this->connection->channel();
        $this->topology->declare($channel);

        /*
         * prefetch=1: брокер не выдаёт следующее сообщение, пока не получил
         * ack/reject по-текущему. Для предсказуемости при ручном ack
         */
        $channel->basic_qos(prefetch_size: 0, prefetch_count: 1, a_global: false);

        $channel->basic_consume(
            queue: Topology::WORK_QUEUE,
            callback: fn(AMQPMessage $message) => $this->handle($message)
        );

        while ($channel->is_consuming()) {
            $channel->wait();
        }
    }

    private function handle(AMQPMessage $message): void
    {
        //Пункт 3. Написать скрипт, который будет читать сообщения из очереди и выводить информацию о них в консоль.
        echo 'Получено сообщение: ' . $message->getBody() . PHP_EOL;

        $message->ack();
    }
}
