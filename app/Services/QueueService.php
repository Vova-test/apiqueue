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
        $queueId = $this->getQueue($attributes);

        if (!$queueId) {
            return false;
        }

        return $this->redis->rpush($queueId->id, $attributes['content']); 
    }

    public function get(array $attributes) 
    {
        $queueId = $this->getQueue($attributes);

        if (!$queueId) {
            return false;
        }

        $content = $this->redis->lpop($queueId->id);
        
        if (!$content) {
            return false;
        }

        return $this->redis->rpush($queueId->id, $content);
    }

     public function getQueue(array $attributes) 
    {
        return $this->repository->getQueue($attributes);
    }
}
