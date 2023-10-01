<?php

namespace App\Repositories\Eloquent;

use App\Models\Support as Model;
use App\Repositories\PaginationInterface;
use App\Repositories\Presenters\PaginationPresenter;
use App\Repositories\SupportRepositoryInterface;
use Illuminate\Pagination\PaginationState;

class SupportRepository implements SupportRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getByStatus(string $status = 'P', int $page): PaginationInterface
    {
        
        // $limit = 15;
        // $skip = ($page - 1) * $limit;

        $supports = $this->model
            ->where('status', $status)
            ->with(['user', 'lesson'])
            // ->skip($skip)
            // ->limit($limit)
            ->paginate();

        return new PaginationPresenter($supports);
    }

    public function findById(string $id): object|null
    {
        return $this->model
                    ->with('user', 'lesson', 'replies.user', 'replies.admin')
                    ->find($id);
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
