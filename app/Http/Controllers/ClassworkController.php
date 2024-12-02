<?php

namespace App\Http\Controllers;

use App\Enums\ClassworkStatus;
use App\Enums\ClassworkUserStatus;
use App\Enums\UserRole;
use App\Events\ClassworkCreated;
use App\Http\Requests\ClassworkRequest;
use App\Models\Classroom;
use App\Models\ClassroomUser;
use App\Models\Classwork;
use App\Models\ClassworkUser;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ClassworkController extends Controller
{
    public function __construct()
    {
        $this->middleware('classroom.classwork')->only(['show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Classroom $classroom)
    {
        // dd($this->getReadyData($request, $classroom));
        return view('classroom.classwork', $this->getReadyData($request, $classroom));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassworkRequest $request, Classroom $classroom)
    {
        // dd($request->all(),$request->validated());
        $this->authorize('create', [Classwork::class, $classroom]);
        // dd($request->all(),$request->validated());
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $classwork = Classwork::create([
                ...$data,
                'classroom_id' => $classroom->id,
            ]);
            $classwork->users()->attach($data['students'] ?? []);
            ClassworkCreated::dispatch($classwork); // event(new static(...func_get_args()))
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return back()->with('success', 'create new classwork successflly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom, Classwork $classwork)
    {
        return view('classroom.classwork-show', [
            'classwork' => $classwork->load('comments.user'),
            'classroom' => $classroom,
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classwork $classwork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom, Classwork $classwork): RedirectResponse
    {
        $classroom->classworks()->findOrFail($classwork->id);
        $classwork->update([
            'topic_id' => '',
            'title' => '',
            'description' => '',
            'status' => '',
            'published_at' => '',
            'options' => '',
        ]);
        return back()->with('success', 'update information for classwork ' . $classwork->title . ' successfflly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom, Classwork $classwork): RedirectResponse
    {
        $classroom->classworks()->findOrFail($classwork->id);
        $classwork->delete();
        return back()->with('success', 'delete classwork ' . $classwork->title . ' successflly');
    }
    
    protected function getReadyData(Request $request, Classroom $classroom)
    {
        $isTeacher = ClassroomUser::where([
            'user_id' => Auth::id(),
            'role' => UserRole::TEACHER->value,
            'classroom_id' => $classroom->id
        ])->exists();
// dd($isTeacher);
        $data = [
            'classroom' => $classroom,
        ];

        if ($isTeacher) {
            $classworks = $classroom
                ->classworks()
                ->with('topic:id,name')
                ->withCount(
                    [
                        'users as assigned_user' => function (Builder $query) {
                            $query->where('classwork_user.status', ClassworkUserStatus::ASSIGNED->value);
                        },
                        'users as submitted_user' => function (Builder $query) {
                            $query->where('classwork_user.status', ClassworkUserStatus::SUBMITTED->value);
                        },
                        'users as evaluated_user' => function (Builder $query) {
                            $query->where('classwork_user.status', ClassworkUserStatus::EVALUATED->value);
                        },
                    ]
                )->get();
                // dd($classroom->topics->pluck('name','id'));
            $data['topics'] = $classroom->topics->pluck('name','id');
            $data['topics_without_classworks'] = $classroom->topics()->doesntHave('classworks')->pluck('name', 'id');
            $data['classworks'] = $classworks->groupBy('topic_id');
            $data['students'] = $classroom->students()->pluck('name', 'id');
            $data['classrooms'] = ClassroomUser::with('classroom:id,name,theme')->teachers()->where('classroom_id', '<>', $classroom->id)->get();
        } else {
            // $classworks = ClassworkUser::where(['user_id'=>Auth::id(),'classroom_id' => $classroom->id])
            // $data['classworks'] = '';
            $data['topics'] = $classroom->topics()->has('classworks')->pluck('name','id');
            $data['classworks'] = $classroom->classworks()->whereHas('users',function($builder) {
                $builder->where('id',Auth::id());
            })->with('topic:id,name')->get()->groupBy('topic_id');
            $data['topics_without_classworks'] = collect([]);
            $data['students'] = collect([]);
            $data['classrooms'] = [];
        }

        return $data;
    }

}
