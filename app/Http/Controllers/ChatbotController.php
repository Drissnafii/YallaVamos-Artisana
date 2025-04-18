<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function handleQuery(Request $request)
    {
        // Logic for handling chatbot queries
        return response()->json([
            'message' => 'Your query has been received',
            'query' => $request->input('query')
        ]);
    }
}
