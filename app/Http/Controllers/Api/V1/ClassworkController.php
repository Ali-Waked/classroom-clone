<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\ClassworkCreated;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Classwork;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ClassworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Classroom $classroom)
    {
        return $classroom->classworks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Classroom $classroom):JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $classwork = $classroom->classworks()->create($data);
            $classwork->users()->attach($data['students']);
            ClassworkCreated::dispatch($classwork);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return Response::json([
            'message' => 'create new Classwork success',
            'classwork' => $classwork->except(['updated_at']),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom,Classwork $classwork)
    {
        //
    }
}
