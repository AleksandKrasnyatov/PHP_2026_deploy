<?php

declare(strict_types=1);

use App\EmailValidator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);


$app->get('/', function (Request $request, Response $response): Response {
    $html = <<<'HTML'
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <title>Запрос на что-то долгое по email</title>
        </head>
        <body>
            <h1>Запрос на что-то долгое по email</h1>
            <form method="post" action="/email">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <button type="submit">Отправить</button>
            </form>
        </body>
        </html>
    HTML;

    $response->getBody()->write($html);
    return $response;
});

$app->post('/email', function (Request $request, Response $response): Response {
    $data = $request->getParsedBody();
    $email = trim(is_array($data) ? (string) ($data['email'] ?? '') : '');

    $statusClass = 'success';
    $message = 'Запрос успешно отправлен!';
    if (!new EmailValidator()->validate($email)) {
        $statusClass = 'error';
        $message = 'Указан не корректный email';
    }

    $html = <<<HTML
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <title>Ответ по запросу</title>
            <style>
                .success { color: green; }
                .error { color: crimson; }
            </style>
        </head>
        <body>
            <h1>Ответ по запросу</h1>
            <p class="{$statusClass}">{$message}</p>
            <p><a href="/">Вернуться к форме</a></p>
        </body>
        </html>
    HTML;

    $response->getBody()->write($html);
    return $response;
});

$app->run();
