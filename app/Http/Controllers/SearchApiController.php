<?php

namespace App\Http\Controllers;

use App\Models\Search;
use App\Services\GitService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SearchApiController extends Controller
{
    public GitService $gitService;

    public function __construct(GitService $gitService)
    {
        $this->gitService = $gitService;
    }

    public function find(Request $request)
    {
        $query = $request->input('body');

        if(isset($query)){
            $results = $this->gitService->getData($query);
        }

        return response()->json([
            'status' => 'success',
            'data' => $results ?? null,
            'query' => $request,
        ]);
    }


    public function delete(Request $request)
    {
        $query = $request->input('body');

        $this->gitService->delete($query);

        return response()->json(['message' => 'Search deleted']);
    }
}
