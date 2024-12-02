<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Classroom;
use App\Models\ClassroomUser;
use App\Models\Scopes\UserClassroomScope;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;

class JoinClassroomController extends Controller
{
    public function create(Request $request,string $id): View|RedirectResponse
    {
        $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)->findOrFail($id);
        $type = UserRole::STUDENT->value;
        try {
            $this->exsits($classroom, Auth::id());
        } catch (\Exception $e) {
            return to_route('classroom.show', $id);
        }
        if($request->query('role') == UserRole::TEACHER->value){
            $type = UserRole::TEACHER->value;
        }
        return view('classroom.join', ['classroom' => $classroom,'type' => $type]);
    }
    public function store(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'role' => [new Enum(UserRole::class)],
        ]);
        $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)->findOrFail($id);
        try {
            $this->exsits($classroom, Auth::id());
        } catch (\Exception $e) {
            return to_route('classrooms.show', $id);
        }
        ClassroomUser::create([
            'classroom_id' => $id,
            'role' => $request->query('role', UserRole::STUDENT->value),
        ]);
        return to_route('classroom.show', $id);
    }
    protected function exsits(object $classroom, int $user_id): void
    {
        $exists = $classroom->users()->wherePivot('user_id', $user_id)->exists();
        if ($exists) {
            throw new \Exception('user alread joined the classroom');
        }
    }
}
