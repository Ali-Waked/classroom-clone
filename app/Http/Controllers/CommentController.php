<?php

namespace App\Http\Controllers;

use App\Actions\Comments\CreateNewComment;
use App\Http\Requests\CommentRequest;
use App\Models\Classwork;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(CommentRequest $request, CreateNewComment $createNewComment, Classwork $classwork): RedirectResponse
    {
        $createNewComment->handle($request, $classwork);
        return back()->with('success', 'added comment');
    }
}
