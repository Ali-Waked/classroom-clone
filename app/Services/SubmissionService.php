<?php

namespace App\Services;

use App\Enums\ClassworkUserStatus;
use App\Http\Requests\SubmissionRequest;
use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\ClassworkUser;
use App\Models\Submission;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionService
{
    /**
     * Show Submission
     *
     * @param Classwork $classwork
     * @return Collection
     */
    public function showAllSubmission(Classwork $classwork): Collection
    {
        $submissions = Auth::user()
            ->submissions()
            ->where('classwork_id', $classwork->id)
            ->get();
        return $submissions;
    }
    public function storeSubmission(SubmissionRequest $request, Classwork $classwork):void
    {
        $user = Auth::user();
        $data = [];
        foreach ($request->file('files') as $file) {
            $data[] = [
                'user_id' => $user->id,
                'classwork_id' => $classwork->id,
                'content' => $file->store("submissions/{$classwork->id}"),
                'type' => 'file',
                'updated_at' => now(),
            ];
        }
        $user->submissions()->insert($data);
        ClassworkUser::where([
            'user_id' => Auth::id(),
            'classwork_id' => $classwork->id,
        ])->update([
            'status' => ClassworkUserStatus::SUBMITTED->value,
            'submitted_at' => now(),
        ]);
    }
    public function deleteSubmission(Submission $submission): bool
    {
        return $submission->delete();
    }
}
