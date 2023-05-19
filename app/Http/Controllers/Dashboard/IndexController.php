<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class IndexController extends Controller
{
    private $userRepository;
    private $commentRepository;
    public function __construct(UserRepositoryInterface $userRepositoryInterface, CommentRepositoryInterface $commentRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
        $this->commentRepository = $commentRepositoryInterface;
    }
    public function index()
    {
        $usersCount = $this->userRepository->getAll(['length' => 0])['metadata']['recordsTotal'];
        $commentsCount = $this->commentRepository->getAll(['length' => 0])['metadata']['recordsTotal'];
        return view('dashboard.index', compact('usersCount', 'commentsCount'));
    }
}
