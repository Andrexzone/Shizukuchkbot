<?php

use SergiX44\Nutgram\Nutgram;

function shizukuSendMessage(Nutgram $bot, string $chatId, string $text, array $options = []): void
{
    $prefix = "🕷️ ...Shizuku here. ";
    $fullText = $prefix . $text . "\n\n💜 Don't make me repeat myself.";
    
    $bot->sendMessage($fullText, array_merge([
        'chat_id' => $chatId,
        'parse_mode' => 'HTML'
    ], $options));
}

function shizukuSendPhoto(Nutgram $bot, string $chatId, string $photoUrl, string $caption = ''): void
{
    $caption = $caption ?: "🕷️ Something I found... or maybe not.";
    $bot->sendPhoto($photoUrl, [
        'chat_id' => $chatId,
        'caption' => $caption,
        'parse_mode' => 'HTML'
    ]);
}

function shizukuSendVideo(Nutgram $bot, string $chatId, string $videoUrl, string $caption = ''): void
{
    $caption = $caption ?: "🕷️ Moving through the shadows...";
    $bot->sendVideo($videoUrl, [
        'chat_id' => $chatId,
        'caption' => $caption,
        'parse_mode' => 'HTML'
    ]);
}

// Puedes añadir aquí sendDocument, sendSticker, sendAnimation, etc.
