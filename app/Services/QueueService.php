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
        $record = $this->getQueue($attributes);
        if ($record) {
            return ['result' => 'There is the queue with name '.$attributes['title']];
        }
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
        $queue = $this->getQueue($attributes);
        if (!$queue) {
            return false;
        }
        return $this->redis->rpush($queue->id, $attributes['content']); 
    }

    public function get(array $attributes) 
    {
        $queue = $this->getQueue($attributes);

        if (!$queue) {
            return false;
        }

        $content = $this->redis->lpop($queue->id);
        
        if (!$content) {
            return false;
        }

        return $this->redis->rpush($queue->id, $content);
    }

     public function getQueue(array $attributes) 
    {
        return $this->repository->getQueue($attributes);
    }
}
