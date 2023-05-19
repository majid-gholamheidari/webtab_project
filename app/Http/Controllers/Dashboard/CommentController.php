<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\CommentAcceptance;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CommentRequest;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $commentRepository;
    public function __construct(CommentRepositoryInterface $commentRepositoryInterface)
    {
        $this->commentRepository = $commentRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.comments.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        $this->commentRepository->store($request->all());
        return redirect()->route('dashboard.comments.index')->with('success', 'Comment created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = $this->commentRepository->findById($id);
        $commentReplay = $comment->children->where('user_id', null)->first();
        return view('dashboard.comments.edit', compact('comment', 'commentReplay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, string $id)
    {
        $this->commentRepository->update($id, $request->only(['status']));
        $comment = $this->commentRepository->findById($id);
        if ($request->replay) {
            $comment = $this->commentRepository->findById($id);
            $commentReplay = $comment->children->where('user_id', null)->first();
            if ($commentReplay) {
                $this->commentRepository->update($commentReplay->id, ['text' => $request->replay]);
            } else {
                $this->commentRepository->store([
                    'admin_id' => Auth::guard('admin')->id(),
                    'user_id' => null,
                    'parent_id' => $id,
                    'text' => $request->replay,
                    'status' => config('constants.comments.status.accepted')
                ]);
            }
        }
        event(new CommentAcceptance($comment, $comment->user));
        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->commentRepository->destory($id);
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }}
