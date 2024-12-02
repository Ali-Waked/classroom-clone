<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\ClassroomUser;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Classroom::with('user:id,name')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomRequest $request): Classroom
    {
        DB::beginTransaction();
        try {
            $classroom = Classroom::create($request->validated());
            ClassroomUser::create([
                'role' => UserRole::TEACHER->value,
                'classroom_id' => $classroom->id,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $classroom;
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom): Classroom
    {
        return $classroom->load(['user:id,name', 'classworks']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassroomRequest $request, Classroom $classroom): JsonResponse
    {
        $classroom->update($request->validated());
        return Response::json([
            'message' => 'updated classroom ' . $classroom->name . ' successflly',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom): JsonResponse
    {
        $classroom->delete();
        return Response::json([
            'message' => 'delete classroom ' . $classroom->name . ' successflly',
        ]);
    }
}
