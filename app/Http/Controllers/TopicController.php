<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Classroom;
use App\Models\Topic;
use App\Services\TopicService;
use Illuminate\Http\RedirectResponse;

class TopicController extends Controller
{
    public function __construct(public TopicService $topicService)
    {
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(TopicRequest $request, Classroom $classroom): RedirectResponse
    {
        $this->topicService->createTopic($classroom, $request->validated());
        return back()->with('success', 'created new topic successflly');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TopicRequest $request, Classroom $classroom, Topic $topic): RedirectResponse
    {
        $this->authorize('updateOrDelete', [Topic::class, $classroom]);
        $this->topicService->updateTopic($topic, $request->validated());
        return back()->with('success', "rename {$topic->name} topic to {$request->name} successflly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom, Topic $topic): RedirectResponse
    {
        $this->authorize('updateOrDelete', [Topic::class, $classroom]);
        $this->topicService->deleteTopic($topic);
        return back()->with('success', "deleted topic {$topic->name} successflly");
    }
}
