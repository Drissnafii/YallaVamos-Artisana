<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ChatbotController extends Controller
{
    public function handleQuery(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = $request->input('message');
        
        try {
            // For now, use a mock response to test the chat interface
            // This will simulate AI responses without actually calling the Gemini API
            $mockResponses = [
                // Greetings
                'hello' => 'Hello! How can I help you with information about Morocco or the 2030 World Cup?',
                'hi' => 'Hi there! I am your Morocco 2030 World Cup assistant. What would you like to know?',
                
                // Identity questions
                'who are you' => 'I am the Morocco 2030 World Cup AI assistant, designed to provide information about the upcoming tournament, host cities, stadiums, accommodations, and travel tips for visitors to Morocco.',
                'your name' => 'I am the Morocco 2030 World Cup AI assistant. I don\'t have a personal name, but you can call me your World Cup guide!',
                'who are u' => 'I am the Morocco 2030 World Cup AI assistant, here to help you with any information about the tournament and Morocco as a host country.',
                
                // Time-related questions
                'today' => 'Today is ' . date('l, F j, Y') . '. The 2030 World Cup is coming in a few years, and Morocco is busy preparing to be an amazing host country!',
                'time' => 'The current time is ' . date('g:i A') . '. Morocco is in the GMT+1 timezone (Western European Time).',
                'date' => 'Today is ' . date('F j, Y') . '. The 2030 FIFA World Cup will be held in Morocco, Spain, and Portugal.',
                
                // World Cup information
                'morocco' => 'Morocco is a beautiful country in North Africa that will be co-hosting the 2030 FIFA World Cup along with Spain and Portugal. It has a rich culture, stunning landscapes, and passionate football fans!',
                'world cup' => 'The 2030 FIFA World Cup will be co-hosted by Morocco, Spain, and Portugal. This will be Morocco\'s first time hosting the tournament, which is especially exciting after their impressive semifinal run in the 2022 World Cup.',
                'when' => 'The 2030 FIFA World Cup is scheduled to take place in the summer of 2030 across venues in Morocco, Spain, and Portugal. The exact dates will be announced closer to the tournament.',
                
                // Venue information
                'stadiums' => 'Morocco is preparing several world-class stadiums for the 2030 World Cup, including venues in Casablanca, Rabat, Marrakech, Tangier, and Agadir. These stadiums are being built or renovated to meet FIFA\'s international standards.',
                'cities' => 'The Moroccan host cities for the 2030 World Cup are expected to include Casablanca, Rabat, Marrakech, Tangier, Fez, and Agadir. Each offers unique cultural experiences for visitors.',
                
                // Other tournament information
                'teams' => 'The 2030 World Cup will feature 48 teams from around the world, competing in the most prestigious football tournament. Qualification processes will begin a few years before the tournament.',
                'players' => 'The 2030 World Cup will showcase the world\'s best football talent. While it\'s too early to know which specific players will participate, many young stars of today may be at their peak during the tournament.',
                'qualification' => 'Qualification for the 2030 World Cup will likely begin around 2027-2028. The tournament will feature 48 teams from all six FIFA confederations.',
                
                // Visitor information
                'accommodations' => 'Morocco is expanding its hotel and accommodation infrastructure to welcome the millions of visitors expected for the 2030 World Cup. Options will range from luxury hotels to budget-friendly hostels and vacation rentals.',
                'travel' => 'Morocco is investing in transportation infrastructure including airports, railways, and highways to ensure smooth travel for World Cup visitors in 2030. The country is well-connected to Europe and has good internal transportation options.',
                'food' => 'Moroccan cuisine is renowned worldwide for its flavors and diversity. Visitors during the 2030 World Cup can enjoy traditional dishes like tagine, couscous, pastilla, and mint tea. The country offers everything from street food to fine dining experiences.',
                'culture' => 'Morocco has a rich cultural heritage blending Berber, Arab, and European influences. Visitors during the 2030 World Cup can explore ancient medinas, visit historic mosques and palaces, and experience traditional music and crafts.',
                'safety' => 'Morocco is working to ensure the 2030 World Cup will be safe and secure for all visitors. The country has experience hosting large international events and is implementing comprehensive security measures for the tournament.',
                
                // Fun facts
                'facts' => 'Fun fact: Morocco was the first African team to reach the World Cup semifinals, achieving this historic milestone in the 2022 tournament in Qatar. Their co-hosting of the 2030 World Cup represents another milestone for African football.',
                'did you know' => 'Did you know? The 2030 World Cup will mark 100 years since the first FIFA World Cup tournament, which was held in Uruguay in 1930. Morocco, Spain, and Portugal are planning special commemorations for this centennial celebration.',
            ];
            
            // Default response if no keywords match
            $aiResponse = 'I am your Morocco 2030 World Cup assistant. I can provide information about host cities, stadiums, teams, accommodations, travel tips, and more. Feel free to ask me about anything related to Morocco or the 2030 World Cup!';
            
            // Check if the user message contains any of our keywords
            $userMessageLower = strtolower($userMessage);
            foreach ($mockResponses as $keyword => $response) {
                if (strpos($userMessageLower, $keyword) !== false) {
                    $aiResponse = $response;
                    break;
                }
            }
            
            // Add a small delay to simulate API processing time
            sleep(1);
            
            return response()->json(['reply' => $aiResponse]);
            
        } catch (Exception $e) {
            Log::error('Chat processing error: ' . $e->getMessage());
            return response()->json(['error' => 'Sorry, I encountered an error while processing your message.'], 500);
        }
    }
}
