<?php

namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface
{
    public function getAll(array $request);
    public function getAllOfUser(array $request, $userId);
    public function findById(int $userId);
    public function store(array $data);
    public function update(int $userId, array $data);
    public function destory(int $userId);
}
