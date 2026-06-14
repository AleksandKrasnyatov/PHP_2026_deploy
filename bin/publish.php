#!/usr/bin/env php
<?php

declare(strict_types=1);

use App\Domain\ValueObject\Email;
use App\Infrastructure\RabbitMq\Worker\Producer;

require __DIR__ . '/../vendor/autoload.php';

$email = $argv[1] ?? null;

if ($email === null || trim($email) === '') {
    fwrite(STDERR, "Usage: php bin/publish.php <email>" . PHP_EOL);
    exit(1);
}

$email = new Email($email);

Producer::create()->publish($email);

echo 'Published: ' . $email->value . PHP_EOL;
