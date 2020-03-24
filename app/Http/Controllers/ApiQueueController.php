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
            'title' => $request->headers->get('title'),
            'user_id' => $request->user->id
        ]);
    }

    public function delete(Request $request) 
    {
        return $this->queueService->delete([
            'title' => $request->headers->get('title'),
            'user_id' => $request->user->id
        ]);
    }

    public function add(Request $request) 
    {
        return $this->queueService->set([
            'user_id' => $request->user->id,
            'title' => $request->headers->get('title'),
            'content' => $request->headers->get('content')
        ]);
    }

    public function get(Request $request) 
    {
        return $this->queueService->get([
            'user_id' => $request->user->id,
            'title' => $request->headers->get('title')
        ]);
    }

    /*public function isJson(String $string)
    {
        return is_string($string) 
            && is_array(json_decode($string, true)) 
            && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }*/
}