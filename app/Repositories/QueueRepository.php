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

    public function delete(string $queueKey)
    {
        return $this->model
                    ->where('queue_key', $queueKey)
                    ->delete();
    }
}