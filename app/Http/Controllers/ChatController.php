<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ChatService; 

class ChatController extends Controller
{
    protected $chatService;

    // Injection de dépendance
    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function createChat(Request $request)
    {
        $validated = $request->validate([
            'targetUserId' => 'required'
        ]);


        $response = $this->chatService->startPrivateChat($validated['targetUserId']);
        
        if (isset($response['error'])) {
            return response()->json($response, 400); 
        }

        return response()->json($response, 200);
    }
}