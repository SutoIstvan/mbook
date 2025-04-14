<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Memorial;
use Illuminate\Support\Facades\Auth;

class OpenAIController extends Controller
{
    public function generateBiography(Memorial $memorial)
    {

        $prompt = __("aigenerate.prompt");

        // Добавляем имя умершего
        $prompt .= __("aigenerate.name") . ": {$memorial->name}\n";

        $prompt .= __("aigenerate.birth_date") . ": {$memorial->birth_date}\n";
        $prompt .= __("aigenerate.death_date") . ": {$memorial->death_date}\n";

        // Получаем членов семьи и их роли
        $familyMembers = $memorial->family;

        if ($familyMembers->isNotEmpty()) {
            $prompt .= "\n" . __("aigenerate.family_members") . "\n";

            foreach ($familyMembers as $member) {
                // Переводим роль на нужный язык
                $role = __('aigenerate.' . $member->role);  // Например: 'father', 'mother', и т.д.
                $prompt .= "- {$role}: {$member->name}\n";
            }
        }

        $timelines = $memorial->timeline()->orderBy('date_from')->get();

        if ($timelines->isNotEmpty()) {
            $prompt .= "\n" . __("aigenerate.timeline_title") . "\n";

            foreach ($timelines as $event) {
                // Перевод типа события
                $eventType = __('aigenerate.timeline_types.' . $event->type);

                // Строка события
                $eventLine = "- {$eventType}";

                if ($event->date_from) {
                    $eventLine .= " ({$event->date_from})";
                } elseif ($event->date) {
                    $eventLine .= " ({$event->date})";
                }

                if ($event->title) {
                    $eventLine .= ": {$event->title}";
                }

                if ($event->location) {
                    $eventLine .= " ({$event->location})";
                }

                $prompt .= $eventLine . "\n";
            }
        }


        dd($prompt);

        // Отправка запроса в OpenAI
        if ($memorial->generation_attempts_left > 0) {

            $response = \Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);
        
            if ($response->successful()) {
                $biography = $response['choices'][0]['message']['content'];
        
                $memorial->biography = $biography;
                $memorial->generation_attempts_left = max(0, $memorial->generation_attempts_left - 1);
                $memorial->save();
        
                return view('memorial.createpreview', compact('memorial'));
            } else {
                return back()->with('error', 'Hiba történt a biográfia generálása közben. Próbáld újra később.');
            }
        
        } else {
            return back()->with('error', __('aigenerate.limit_reached')); // или просто строка типа "A generálási lehetőségek elfogytak."
        }

        // $memorial->biography = $prompt;
        // $memorial->save();

        // return response()->json([
        //     'error' => 'Ошибка при получении ответа от OpenAI',
        //     'details' => $response->json(),
        // ], $response->status());

        return view('memorial.createpreview', compact('memorial'));
    }
}
