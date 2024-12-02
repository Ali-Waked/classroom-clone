<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Services\ClassroomService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ClassroomController extends Controller
{
    public function __construct(public ClassroomService $classroomService)
    {
        $this->middleware('subscribed')->only(['store']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('classroom.index', [
            'classrooms' => Classroom::all(),
            // 'streams' => Stream::all(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomRequest $request): RedirectResponse
    {
        try {
            $this->classroomService->createClassroom($request->validated());
        } catch (Exception $e) {
            throw $e;
        }
        return to_route('classroom.index')->with('success', 'create new classroom successflly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom): View
    {
        return view('classroom.show', [
            'classroom' => $classroom,
            'classworks' => $classroom->classworks,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ClassroomRequest $request, Classroom $classroom): RedirectResponse
    {
        $this->classroomService->updateClassroom($classroom, $request->validated());
        return to_route('classroom.index')->with('success', "update classroom {$classroom->name} successflly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom): RedirectResponse
    {
        $this->classroomService->deleteClassroom($classroom);
        return to_route('classroom.index')->with('success', "make classroom {$classroom->name} archive");
    }
    public function trash(): View
    {
        return view('classroom.trash', [
            'classrooms' => Classroom::onlyTrashed()->get(),
        ]);
    }
    public function restore(string $classroom): RedirectResponse
    {
        $classroom = $this->classroomService->restoreClassroom($classroom);
        return Redirect::route('classroom.index')->with('success', "restore {$classroom->name} class successflly");
    }
    public function forceDelete(string $classroom): RedirectResponse
    {
        $classroom = $this->classroomService->forceDelteClassroom($classroom);
        return Redirect::route('classroom.trashed')->with('success', "deleted {$classroom->name} class successflly");
    }
}
