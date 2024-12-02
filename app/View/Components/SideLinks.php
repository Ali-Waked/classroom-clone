<?php

namespace App\View\Components;

use App\Models\Classroom;
use App\Models\ClassroomUser;
use App\Models\Classwork;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SideLinks extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // dd(ClassroomUser::with('classroom:id,name,theme')->students()->get());
        // dd(ClassroomUser::has('classroom')->with('classroom:id,name,theme')->teachers()->get());
        return view('components.side-links', [
            'teacherClassrooms' => ClassroomUser::has('classroom')->with('classroom:id,name,theme')->teachers()->get(),
            'studentClassrooms' => ClassroomUser::has('classroom')->with('classroom:id,name,theme')->students()->get(),
            // 'studentClassrooms' => [],
        ]);
    }
}
