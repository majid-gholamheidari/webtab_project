@extends('dashboard.layouts.master')

@section('title', 'Comment details')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Comment details</h3>
                        <a href="{{ route('dashboard.comment.index') }}" class="btn btn-sm btn-outline-success" style="position: absolute; bottom: 6px; right: 8px;">back to comments</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('dashboard.comment.update', $comment->id) }}" method="POST" >
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-grou">
                                        <label>Text</label>
                                        <textarea disabled readonly cols="30" rows="5" class="form-control">{{ $comment->text }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="form-grou">
                                        <label>User</label>
                                        <input type="text" class="form-control" disabled readonly value="{{ $comment->user->full_name }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-grou">
                                        <label for="status">Status <span class="text-danger">*</span> </label>
                                        <select name="status" id="status" class="form-control">
                                            <option {{ $comment->status == config('constants.comments.status.accepted') ? 'selected' : '' }} value="{{ config('constants.comments.status.accepted') }}">Accepted</option>
                                            <option {{ $comment->status == config('constants.comments.status.rejected') ? 'selected' : '' }} value="{{ config('constants.comments.status.rejected') }}">Rejected</option>
                                            <option {{ $comment->status == config('constants.comments.status.pending') ? 'selected' : '' }} value="{{ config('constants.comments.status.pending') }}">Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-grou">
                                        <label for="replay">Replay</label>
                                        <textarea name="replay" id="replay" cols="30" rows="5" class="form-control">{{ $commentReplay ? $commentReplay->text : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-grou mt-3">
                                        <button class="btn btn-success btn-block">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</section>
@endsection
