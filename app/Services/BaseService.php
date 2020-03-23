<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;

class BaseService implements ServiceInterface
{
    public function all()
    {
        return $this->repository->all();
    }

    public function delete(string $id)
    {
        return $this->repository->delete($id);
    }

    public function find(string $id)
    {
        return $this->repository->find($id);
    }

    public function getForAutocomplete(string $query)
    {
        return $this->repository->getForAutocomplete($query);
    }

    public function create(array $attributes)
    {
        if (property_exists($this->repository->model, 'inClinic') &&
            !array_key_exists('clinic_id', $attributes) &&
            $this->repository->model->inClinic) {
            $attributes['clinic_id'] = app('user')->clinic_id;
        }

        return $this->repository->create($attributes);
    }

    public function count()
    {
        return $this->repository->count();
    }
}
