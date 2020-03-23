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

    public function main(Request $request, string $type) 
    {    
        if ($type == 'c') {
            return $this->queueService->create([
                'user_name' => $request->user,
                'email' => $request->email,
                'queue_title' => $request->title,
                'queue_key' => $request->title.time()
            ]);
        }

        if ($type == 'd') {
            return $this->queueService->delete($request->key);
        }

        if ($type == 's') {
            return $this->queueService->set([
                'key' => $request->key,
                'content' => $request->content
            ]);
        }

        if ($type == 'g') {
            return $this->queueService->get($request->key);
        }

        return "The format isn't validated!";
    }

    /*public function isJson(String $string)
    {
        return is_string($string) 
            && is_array(json_decode($string, true)) 
            && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }*/
}