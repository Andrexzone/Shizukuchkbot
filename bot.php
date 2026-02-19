<?php

require __DIR__ . '/vendor/autoload.php';

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\Webhook;
use Dotenv\Dotenv;

// Cargar variables (aunque en Railway no es necesario, lo dejamos por si acaso)
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$bot = new Nutgram($_ENV['TOKEN']);

// FORZAMOS MODO WEBHOOK CON EL SECRET EXACTO
$bot->setRunningMode(new Webhook(secretToken: 'shizuku_secret_2026_random_largo'));

// Logging básico para debug (opcional, pero útil ahora)
$bot->onException(function (Exception $e) {
    file_put_contents('logs/error.log', date('Y-m-d H:i:s') . ' - ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
});

// ==================== COMANDOS SHIZUKU ====================

$bot->onCommand('start', function (Nutgram $bot) {
    $chatId = $bot->getChat()->getId();
    shizukuSendMessage($bot, $chatId, "I am Shizuku Murasaki... member of the Phantom Troupe. What do you want?");
});

$bot->onCommand('help', function (Nutgram $bot) {
    $chatId = $bot->getChat()->getId();
    shizukuSendMessage($bot, $chatId, "Commands I remember right now:\n/start - Wake me up\n/help - This useless list\n\nJust talk to me... I might answer.");
});

$bot->onCommand('vacuum', function (Nutgram $bot) {
    $chatId = $bot->getChat()->getId();
    shizukuSendMessage($bot, $chatId, "Blinky is ready... What should I suck in today?");
});

// ==================== CUALQUIER TEXTO ====================

$bot->onText('.*', function (Nutgram $bot) {
    $chatId = $bot->getChat()->getId();
    $text = $bot->getMessage()->getText() ?? 'Nothing...';

    if (rand(1, 5) === 1) {
        shizukuSendMessage($bot, $chatId, "Wait... have we met before? Anyway... " . $text);
    } else {
        shizukuSendMessage($bot, $chatId, "Your words are... " . $text);
    }
});

// ==================== EJECUCIÓN ====================

// Log para confirmar que recibe updates
file_put_contents('logs/webhook.log', date('Y-m-d H:i:s') . " - Update recibido\n", FILE_APPEND);

$bot->run();$bot->onText('.*', function (Nutgram $bot) {
    $chatId = $bot->getChat()->getId();
    $text = $bot->getMessage()->getText() ?? 'Nothing...';

    if (rand(1, 5) === 1) {
        shizukuSendMessage($bot, $chatId, "Wait... have we met before? Anyway... " . $text);
    } else {
        shizukuSendMessage($bot, $chatId, "Your words are... " . $text);
    }
});

// ==================== EJECUCIÓN ====================

// Log para ver updates recibidos
file_put_contents('logs/bot.log', "Received update: " . file_get_contents('php://input') . PHP_EOL, FILE_APPEND);

$bot->run();
