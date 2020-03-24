<?php

namespace App\Repositories;

use App\Models\Queue;

class QueueRepository
{
    public function __construct(Queue $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        $class = get_class($this->model); 

        $model = new $class();

        return $model->create($attributes);
    }

    public function delete(array $attributes)
    {
        return $this->model
                    ->where('title', $attributes['title'])
                    ->where('user_id', $attributes['user_id'])
                    ->delete();
    }

    public function getQueueId(array $attributes)
    {
        $queue = $this->model
                      ->where('title', $attributes['title'])
                      ->where('user_id', $attributes['user_id'])
                      ->first();
        return $queue;
    }
}