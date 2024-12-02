<?php

namespace App\Actions\Comments;

use App\Http\Requests\CommentRequest;
use App\Models\Classwork;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateNewComment
{
    /**
     * Create New Comment
     *
     * @param CommentRequest $request
     * @return Comment
     */
    public function handle(CommentRequest $request,Classwork $classwork): Comment
    {
        return Comment::create([
            'commentable_id' => $request->input('id'),
            'classwork_id' => $classwork->id,
            'commentable_type' => Str::ucfirst($request->input('type')),
            'content' => $request->content,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}
