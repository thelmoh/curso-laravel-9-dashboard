<?php

namespace App\Services;

use App\Repositories\SupportRepositoryInterface;
use SebastianBergmann\Type\ObjectType;
use stdClass;

class SupportService
{
    private $repository;

    public function __construct(SupportRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getSupports(string|null $status = 'P')
    {
        return $this->repository->getByStatus($status);
    }
    
    public function findById(string $id): object|null
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): object
    {
        return $this->repository->create($data);
    }

    public function update(string $id, array $data): object|null
    {
        return $this->repository->update($id, $data);
    }

    public function delete(string $id)
    {
        return $this->repository->delete($id);
    }
}
