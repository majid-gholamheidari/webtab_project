<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\NewUserRegistration;
use App\Helpers\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $userRepository;
    private $commentRepository;
    public function __construct(CommentRepositoryInterface $commentRepositoryInterface, UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
        $this->commentRepository = $commentRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        if ($request->file('image')) {
            $userImage = Upload::uploadFile($request->file('image'), '/users-image/' . Carbon::now()->format('Y-m-d'));
            if ($userImage) {
                $data['image_path'] = $userImage;
            }
        }
        $data['password'] = Hash::make($request->password ?? 'P@ssw0rd');
        $user = $this->userRepository->store($data);
        event(new NewUserRegistration($user));
        return redirect()->route('dashboard.user.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userRepository->findById($id);
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->all();
        if ($request->file('image')) {
            $userImage = Upload::uploadFile($request->file('image'), '/users-image/' . Carbon::now()->format('Y-m-d'));
            if ($userImage) {
                $data['image_path'] = $userImage;
            }
        }
        if (is_null($request->get('password'))) {
            unset($data['password']);
        }
        $this->userRepository->update($id, $data);
        return redirect()->back()->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userRepository->findById($id);
        $user->comments()->get()->map(function ($comment) {
            $comment->children()->delete();
        });
        $user->comments()->delete();
        $this->userRepository->destory($id);
        return redirect()->route('dashboard.user.index')->with('success', 'User deleted successfully.');
    }
}
