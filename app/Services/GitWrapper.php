<?php

namespace App\Services;

use App\Models\Search;
use GuzzleHttp\Client;

class GitWrapper
{
    public function getData($searchQuery) {
        // Если данных нет, отправляем запрос на GitHub API
        $client = new Client();
        $response = $client->get('https://api.github.com/search/repositories?q=' . $searchQuery);

        $json = $response->getBody()->getContents();

        // Сохраняем результаты в базу
        Search::query()->create([
            'query' => $searchQuery,
            'results' => $json
        ]);

        return json_decode($json)->items;
    }
}
