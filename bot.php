<?php

require __DIR__ . '/vendor/autoload.php';  // ← Solo esto queda

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\Webhook;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$bot = new Nutgram($_ENV['TOKEN']);

// FORZAMOS MODO WEBHOOK
$bot->setRunningMode(new Webhook(secretToken: $_ENV['WEBHOOK_SECRET']));

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

$bot->run();    // Rol de olvidadiza
    if (rand(1, 5) === 1) {
        shizukuSendMessage($bot, $chatId, "Wait... have we met before? Anyway... " . $text);
    } else {
        shizukuSendMessage($bot, $chatId, "Your words are... " . $text);
    }
});

// ==================== INICIO DEL WEBHOOK ====================

$bot->run();   // ← Esto maneja la petición de Telegram automáticamente
