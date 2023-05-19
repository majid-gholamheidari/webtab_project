<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
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
        $recordsFiltered = User::where(function($query) use ($searchValue) {
            if (!is_null($searchValue)) {
                $query
                    ->where('name', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('lastname', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('phonenumber', 'LIKE', '%' . $searchValue . '%');
            }
        })->count();
        $recordsTotal = User::count();
        $result = User::skip($request['start'] ?? 0)
            ->take($request['length'] ?? 10)
            ->where(function($query) use ($searchValue) {
                if (!is_null($searchValue)) {
                    $query
                    ->where('name', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('lastname', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('phonenumber', 'LIKE', '%' . $searchValue . '%');
                }
            })
            ->orderBy($orderColumn, $orderDir)
            ->get();
        return ['collection' => $result, 'metadata' => ['recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered]];
    }

    public function findById(int $userId)
    {
        return User::find($userId);
    }

    public function store(array $data)
    {
        return User::create($data);
    }

    public function update(int $userId, array $data)
    {
        return User::find($userId)->update($data);
    }

    public function destory(int $userId)
    {
        $user = User::find($userId);
        $user->comments()->get()->map(function($comment) {
            $comment->children()->delete();
        });
        $user->comments()->delete();
        return $user->delete();
    }

}
