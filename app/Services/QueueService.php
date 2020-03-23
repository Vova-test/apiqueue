<?php

namespace App\Services;

use App\Repositories\QueueRepository;
use Illuminate\Support\Facades\Redis;

class QueueService
{
    public function __construct(QueueRepository $repository)
    {
        $this->repository = $repository;
        $this->redis = Redis::connection();
    }

    public function create(array $attributes) 
    {
        if ($this->repository->create($attributes)) {
            return $attributes['queueKey'];
        } 
    }

    public function delete(string $queueKey) 
    {        
        if ($this->repository->delete($queueKey)) {
            return $queueKey;
        }  
    }

    public function set(array $attributes) 
    {
        return $this->redis->rpush($attributes['key'], $attributes['content']); 
        //return $attributes;   
    }

    public function get(string $queueKey) 
    {
        return $this->redis->lpop($queueKey);
        //return 'got queue';  
    }
}
