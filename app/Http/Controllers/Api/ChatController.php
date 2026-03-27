<?php

namespace App\Http\Controllers\Api;

use App\Ai\Agents\DavidAgent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Ai\Messages\Message;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'history' => 'array',
        ]);

        $history = collect($request->input('history', []))->map(function ($msg) {
            return new Message($msg['role'], $msg['content']);
        })->toArray();

        // Add current message
        $history[] = new Message('user', $request->message);

        $agent = new DavidAgent();
        $response = $agent->withHistory($history)->prompt($request->message);

        return response()->json([
            'response' => (string) $response,
            'role' => 'assistant',
        ]);
    }
}
