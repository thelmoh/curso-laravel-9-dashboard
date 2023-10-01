<?php

namespace App\Repositories;

interface SupportRepositoryInterface
{
    public function getByStatus(string $status, int $page): PaginationInterface;
    public function findById(string $id): object|null;
    public function create(array $data): object;
    public function update(string $id, array $data): object|null;
    public function delete(string $id): bool;
}