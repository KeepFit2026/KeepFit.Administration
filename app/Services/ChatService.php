<?php

namespace App\Services;

class ChatService extends AbstractApiService
{
   
    protected function endpoint(): string
    {
        return 'chats';
    }

    /**
     * Appelle la route POST /StartPrivateChat
     */
    public function startPrivateChat(string $targetUserId)
    {
        return $this->post('/StartPrivateChat', [
            'targetUserId' => $targetUserId
        ]);
    }
}