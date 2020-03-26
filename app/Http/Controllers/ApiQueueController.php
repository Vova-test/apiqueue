<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QueueService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\QueueRequest;

class ApiQueueController extends Controller
{
    public function __construct(QueueService $queueService)
    {
        $this->queueService = $queueService;
    }

    public function create(Request $request) 
    {
        $requestArray = $request->post();

        return $this->queueService->create([
            'title' => $requestArray['title'],
            'user_id' => $request->user->id
        ]);
    }

    public function delete(Request $request) 
    {
        $requestArray = $request->post();

        return $this->queueService->delete([
            'title' => $requestArray['title'],
            'user_id' => $request->user->id
        ]);
    }

    public function add(Request $request) 
    {
        $requestArray = $request->post();

        return $this->queueService->set([
            'user_id' => $request->user->id,
            'title' => $requestArray['title'],
            'content' => $requestArray['content']
        ]);
    }

    public function get(Request $request) 
    {
        $requestArray = $request->post();
        
        return $this->queueService->get([
            'user_id' => $request->user->id,
            'title' => $requestArray['title']
        ]);
    }
}