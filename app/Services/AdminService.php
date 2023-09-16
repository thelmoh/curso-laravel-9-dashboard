<?php

namespace App\Services;

use App\Repositories\AdminRepositoryInterface;
use SebastianBergmann\Type\ObjectType;
use stdClass;

class AdminService
{
    private $repository;

    public function __construct(AdminRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(string $filter = ''): array
    {
        $users = $this->repository->getAll($filter);

        return convertArrayToObject($users);
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
