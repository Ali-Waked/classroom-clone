<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Classroom;
use App\Models\Topic;
use App\Services\TopicService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TopicController extends Controller
{
    public function __construct(public TopicService $topicService)
    {
    }
    public function index(Classroom $classroom): Collection
    {
        $this->authorize('view-any', [Topic::class, $classroom]);
        return $classroom->topics;
    }
    public function store(TopicRequest $request, Classroom $classroom): JsonResponse
    {
        $this->authorize('create', [Topic::class, $classroom]);
        $topic = $this->topicService->createTopic($classroom, $request->validated());
        return Response::json([
            'message' => 'create new topic successflly',
            'topic' => $topic->only(['id', 'name', 'classroom_id']),
        ]);
    }
    public function update(TopicRequest $request, Classroom $classroom, Topic $topic): JsonResponse
    {
        $this->authorize('updateOrDelete', [Topic::class, $classroom]);
        $this->topicService->updateTopic($topic, $request->validated());
        return Response::json([
            'message' => 'update topic ' . $topic->name . ' successflly',
        ]);
    }
    public function destroy(Classroom $classroom, Topic $topic): JsonResponse
    {
        $this->authorize('updateOrDelete', [Topic::class, $classroom]);
        $this->topicService->deleteTopic($topic);
        return Response::json([
            'message' => 'delete topic success',
        ]);
    }
}
