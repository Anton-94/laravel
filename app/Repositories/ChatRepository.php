<?php

namespace App\Repositories;

class ChatRepository
{
    public function getAll(): array
    {
        return json_decode(\Redis::get('messages')) ?? [];
    }

    public function save(string $message): void
    {
        $messages = $this->getAll();
        $messages[] = $message;
        \Redis::set('messages', json_encode($messages));
    }
}