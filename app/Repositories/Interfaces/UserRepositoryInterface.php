<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getAll(array $request);
    public function findById(int $userId);
    public function store(array $data);
    public function update(int $userId, array $data);
    public function destory(int $userId);
}
