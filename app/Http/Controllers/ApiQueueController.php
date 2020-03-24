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
        return $this->queueService->create([
            'title' => $request->title,
            'user_id' => $request->user->id
        ]);
    }

    public function delete(Request $request) 
    {
        return $this->queueService->delete([
            'title' => $request->title,
            'user_id' => $request->user->id
        ]);
    }

    public function add(Request $request) 
    {
        return $this->queueService->set([
            'user_id' => $request->user->id,
            'title' => $request->title,
            'content' => $request->content
        ]);
    }

    public function get(Request $request) 
    {
        return $this->queueService->get([
            'user_id' => $request->user->id,
            'title' => $request->title
        ]);
    }
}