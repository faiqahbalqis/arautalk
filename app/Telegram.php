<?php

namespace App;

use Klev\TelegramBotApi\Telegram;

class TelegramBot
{
    private $apiToken;

    public function __construct()
    {
        $this->apiToken = env('TELEGRAM_API_TOKEN');
    }

    public function getApiToken()
    {
        return $this->apiToken;
    }

    public function sendMessage($chatId, $message)
    {
        $telegram = new Telegram($this->apiToken);

        $result = $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
        ]);

        return $result;
    }

    public function getGroupMembers($groupId)
    {
        $telegram = new Telegram($this->apiToken);

        $result = $telegram->getChatMembersCount([
            'chat_id' => $groupId,
        ]);

        if (!$result['ok']) {
            throw new \Exception('Failed to fetch group members');
        }

        return $result['result'];
    }
}
