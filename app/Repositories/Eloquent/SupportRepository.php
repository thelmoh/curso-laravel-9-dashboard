<?php

namespace App\Repositories\Eloquent;

use App\Models\Support as Model;
use App\Repositories\SupportRepositoryInterface;

class SupportRepository implements SupportRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getByStatus(string $status = 'P'): array
    {
        $supports = $this->model
            ->where(function ($query) use ($status) {
                if ($status) {
                    $query->where('status', $status);
                }
            })
            //->with()
            ->get();

        return $supports->toArray();
    }

    public function findById(string $id): object|null
    {
        return $this->model->find($id);
    }

    public function create(array $data): object
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): object|null
    {
        if (!$support = $this->findById($id)) {
            return null;
        }
        
        $support->update($data);

        return $support;
    }

    public function delete(string $id): bool
    {
        if (!$support = $this->findById($id)) {
            return false;
        }

        return $support->delete();
    }
}
