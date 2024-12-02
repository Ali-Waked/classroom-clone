<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Comments\CreateNewComment;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{
    public function store(CommentRequest $request, CreateNewComment $createNewComment): JsonResponse
    {
        $comment = $createNewComment->handle($request);
        return Response::json([
            'message' => 'create new comment',
            'comment' => $comment,
        ]);
    }
}
