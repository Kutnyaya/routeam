<?php

namespace App\Http\Controllers;

use App\Services\GitService;
use Illuminate\Http\Request;
class SearchController extends Controller
{
    public GitService $gitService;
    public function __construct(GitService $gitService)
    {
        $this->gitService = $gitService;
    }

    public function search(Request $request) {

        $searchQuery = $request->search;

        if(isset($searchQuery)){
            $results = $this->gitService->getData($searchQuery);
        }

        return view('search')
            ->with('result', $results ?? null)
            ->with('query', $searchQuery);
    }
}
