<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PeopleController extends Controller
{
    public function index(Classroom $classroom): View
    {
        return view('classroom.people', [
            'teachers' => $classroom->teachers,
            'students' => $classroom->students,
            'classroom' => $classroom,
        ]);
    }
    public function destroy(Request $request, Classroom $classroom)
    {
        $request->validate([
            'user_id' => 'required|int',
        ]);
        $user_id = $request->input('user_id');
        if ($user_id == $classroom->user_id) {
            return back()->with('error', "can't remove!");
        }
        $classroom->users()->detach($user_id);
        return back()->with('success', 'user remove !');
    }
}
