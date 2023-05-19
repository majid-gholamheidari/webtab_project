<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\User;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class CommentRepository implements CommentRepositoryInterface
{
    public function getAll(array $request)
    {
        $searchValue = $request['search']['value'] ?? null;
        $orderColumn = 'created_at';
        $orderDir = 'asc';
        if (isset($request['order']) && count($request['order']) > 0) {
            $columnIndex = $request['order'][0]['column'];
            $orderDir = $request['order'][0]['dir'];
            $orderColumn = $request['columns'][$columnIndex]['data'];
        }
        $recordsFiltered = Comment::where('admin_id', null)->where(function($query) use ($searchValue) {
            if (!is_null($searchValue)) {
                $query
                    ->where('text', 'LIKE', '%' . $searchValue . '%')
                    ->orWhereHas('user', function ($query) use ($searchValue) {
                        return $query
                            ->where('name', 'LIKE', '%' . $searchValue . '%')
                            ->orWhere('lastname', 'LIKE', '%' . $searchValue . '%');
                    });
            }
        })->count();
        $recordsTotal = Comment::where('admin_id', null)->count();
        $result = Comment::skip($request['start'] ?? 0)
            ->take($request['length'] ?? 10)
            ->where('admin_id', null)
            ->where(function($query) use ($searchValue) {
                if (!is_null($searchValue)) {
                    $query
                        ->where('text', 'LIKE', '%' . $searchValue . '%')
                        ->orWhereHas('user', function ($query) use ($searchValue) {
                            return $query
                                ->where('name', 'LIKE', '%' . $searchValue . '%')
                                ->orWhere('lastname', 'LIKE', '%' . $searchValue . '%');
                        });
                }
            })
            ->orderBy($orderColumn, $orderDir)
            ->get();
        return ['collection' => $result, 'metadata' => ['recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered]];
    }

    public function getAllOfUser(array $request, $userId)
    {
        return Comment::where('user_id', $userId)->with('children')->paginate($request['page'] ?? 1);
    }

    public function findById(int $commentId)
    {
        return Comment::find($commentId);
    }

    public function store(array $data)
    {
        return Comment::create($data);
    }

    public function update(int $commentId, array $data)
    {
        return Comment::find($commentId)->update($data);
    }

    public function destory(int $commentId)
    {
        $comment = Comment::find($commentId)->delete();
        $comment->children()->delete();
        return $comment->delete();
    }

}
