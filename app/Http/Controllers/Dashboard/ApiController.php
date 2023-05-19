<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CommentResource;
use App\Http\Resources\Api\UserResource;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    private $userRepository;
    private $commentRepository;
    public function __construct(UserRepositoryInterface $userRepositoryInterface, CommentRepositoryInterface $commentRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
        $this->commentRepository = $commentRepositoryInterface;
    }

    public function usersList(Request $request)
    {
        $users = $this->userRepository->getAll($request->all());
        return response()->json([
            "data" => UserResource::collection($users['collection']),
            "recordsTotal" => $users['metadata']['recordsTotal'],
            "recordsFiltered" => $users['metadata']['recordsFiltered'],
        ]);
    }

    public function commentsList(Request $request)
    {
        $comments = $this->commentRepository->getAll($request->all());
        return response()->json([
            "data" => CommentResource::collection($comments['collection']),
            "recordsTotal" => $comments['metadata']['recordsTotal'],
            "recordsFiltered" => $comments['metadata']['recordsFiltered'],
        ]);
    }

    public function usersWithComments(Request $request)
    {
        $data['search']['value'] = $request->get('search_user', null);
        $data['length'] = $request->get('per_page', 10);
        $data['start'] = ($request->get('page',1) - 1) * $data['length'];
        $users = $this->userRepository->getAll($data);
        $users['collection']->map(function ($user) {
            $user->user_comments = $user->comments()->get();
        });
        return response()->json([
            'data' => UserResource::collection($users['collection']),
            'meta' => [
                'per_page' => $data['length'],
                'total_pages' => ceil($users['metadata']['recordsTotal'] / $request->get('per_page', 1)),
                'current_page' => $request->get('page', 1),
                'total_items' => $users['metadata']['recordsTotal']
            ]
        ]);
    }
}
