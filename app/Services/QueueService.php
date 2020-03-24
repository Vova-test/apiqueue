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
        return $this->repository->create($attributes);
    }

    public function delete(array $attributes) 
    {   
        $record = $this->getQueue($attributes);
        
        if ($record) {
            $this->redis->del($record->id);
            return $record->delete();
        } 

        return false;
    }

    public function set(array $attributes) 
    {
        $idQueue = $this->getQueue($attributes);

        if (!$idQueue) {
            return false;
        }

        return $this->redis->rpush($idQueue->id, $attributes['content']); 
    }

    public function get(array $attributes) 
    {
        $idQueue = $this->getQueue($attributes);

        if (!$idQueue) {
            return false;
        }

        $content = $this->redis->lpop($idQueue->id);
        
        if (!$content) {
            return false;
        }

        if (1 == 1) { 
            return $this->redis->rpush($idQueue->id, $content);
        }

        return ['content' => $content];
    }

     public function getQueue(array $attributes) 
    {
        return $this->repository->getQueueId($attributes);
    }
}
