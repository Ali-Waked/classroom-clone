<?php

namespace App\Http\Controllers;

use App\Enums\ClassworkUserStatus;
use App\Http\Requests\SubmissionRequest;
use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\ClassworkUser;
use App\Models\Submission;
use App\Rules\ForbiddenFile;
use App\Services\SubmissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    public function __construct(public SubmissionService $submissionService)
    {
    }
    public function index(Classroom $classroom, Classwork $classwork): View
    {
        $this->authorize('view-any', [Submission::class, $classroom]);
        $submissions = $this->submissionService->showAllSubmission($classwork);
        return view('', [
            'submissions' => $submissions,
        ]);
    }
    public function store(SubmissionRequest $request, Classwork $classwork): RedirectResponse
    {
        // $this->authorize('create', [Submission::class, $classwork]);
        DB::beginTransaction();
        try {
            $this->submissionService->storeSubmission($request, $classwork);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
        return back()->with('success', 'save submisstion successflly');
    }
    public function destroy(Submission $submission): RedirectResponse
    {
        $this->authorize('delete', [Submission::class, $submission]);
        $this->submissionService->deleteSubmission($submission);
        return back()->with('success', 'delete submisson successflly');
    }
    public function file(Submission $submission)
    {
        $this->authorize('view', [$submission]);
        return response()->file(storage_path('app/' . $submission->content));
    }
}
