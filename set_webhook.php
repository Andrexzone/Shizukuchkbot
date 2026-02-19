<?php

require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$token = $_ENV['TOKEN'];
$webhookUrl = "shizukuchkbot-production.up.railway.app/bot.php";   // ← CAMBIA ESTO

$url = "https://api.telegram.org/bot{$token}/setWebhook?url=" . urlencode($webhookUrl);

echo file_get_contents($url);   // Verás la respuesta de Telegram
