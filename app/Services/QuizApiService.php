<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class QuizApiService
{
    public function getQuizData()
    {
        $response = Http::get('https://the-trivia-api.com/api/questions', [
            'limit' => 100,              
            'categories' => 'sport_and_leisure',  
            'difficulty' => 'medium'       
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
