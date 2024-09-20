<?php

namespace App\Services;

use App\Models\Search;
use GuzzleHttp\Client;

class GitService
{
    public GitWrapper $gitWrapper;
    public function __construct(GitWrapper $gitWrapper)
    {
        $this->gitWrapper = $gitWrapper;
    }

    public function getData($searchQuery)
    {
        // Проверяем, есть ли уже данные в базе
        $search = Search::query()->where('query', $searchQuery)->first();
        $response = [];
        if (!$search) {
            // Если данных нет, отправляем запрос на GitHub API
            $results = $this->gitWrapper->getData($searchQuery);
        }
        else {
            $results = json_decode($search->results)->items;
        }
        foreach ($results as $result) {
            $response[] = [
                'html_url' => $result->html_url,
                'name' => $result->name,
                'owner' => $result->owner->login,
                'stargazers' => $result->stargazers_count,
                'watchers' => $result->watchers_count,
            ];
        }
        return $response;
    }

    public function delete($searchQuery)
    {
        $search_data = Search::query()->where('query', $searchQuery)->first();

        if (isset($search_data)) {
            $search_data->delete();
        }
    }
}
