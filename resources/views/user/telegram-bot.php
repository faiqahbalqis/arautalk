<?php

$telegramToken = '6313151732:AAGJR85aRJambMLCkJtF_ddYJgpBFKbQiMw';

// Handle incoming messages
$update = json_decode(file_get_contents('php://input'), true);
if (isset($update['message'])) {
    $message = $update['message'];
    $chatId = $message['chat']['id'];
    $text = $message['text'];

    // Check for the specific message
    if ($text === 'arautalk notification') {
        // Perform the necessary actions, such as storing the chat ID or sending the automated message
        // ...
    }
}

// Sending a message from the bot
function sendMessage($chatId, $message)
{
    global $telegramToken;
    $url = "https://api.telegram.org/bot$telegramToken/sendMessage";
    $params = [
        'chat_id' => $chatId,
        'text' => $message,
    ];

    $response = file_get_contents($url . '?' . http_build_query($params));
    // Handle the response as needed
}
