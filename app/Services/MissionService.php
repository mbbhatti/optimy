<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MissionService
{
    /**
     * Get external mission list
     *
     * @return array
     */
    public function fetchMissions(): array
    {
        $response = Http::get('https://api.example.com/missions');

        return $response->json();
    }
}
